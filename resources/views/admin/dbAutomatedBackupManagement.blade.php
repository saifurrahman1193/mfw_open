@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'DB Automated Backups Management')

@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"   rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">



@if ( preg_match("/127.0/", Request::ip()) )
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  {{-- <script src="{{ asset('js/vue.js') }}"></script> --}}
@else
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.min.js"></script>
  {{-- <script src="{{ asset('js/vue.min.js') }}"></script> --}}
@endif
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script src="{{ asset('js/mixins/common.js') }}"></script>
<script src="{{ asset('js/modals/alertmixins.js') }}"></script>
<script src="{{ asset('js/modals/alert.js') }}"></script>



<div class="content-wrapper" style="min-height: 0px;"  id="app" >

    <v-app   >
        <v-sheet
          class=" ma-2"
          elevation="0"
          color="grey lighten-5"
        >
        
          <v-main>
              <v-card elevation="0" >
                  <v-card-title primary-title >
                      <v-spacer></v-spacer>
                      DB Automated Backups Management
                      <v-spacer></v-spacer>
                  </v-card-title>

                  <v-card-text>

                        

                        <v-row class="mb-2">
                            
                            <v-col  v-if="isSelected" cols="auto">
                                <v-chip color="pink" outlined  
                                    @click="removeFiles(selected)"
                                >  
                                    <v-icon  color="pink" >delete</v-icon> &nbsp;
                                    <span v-text="'Remove Selected Files'"></span>
                                </v-chip>
                            </v-col>

                            <!-- <v-col  v-if="!isSelected" cols="auto">
                                <v-chip color="pink" outlined  >  
                                    <v-icon  color="pink" >delete</v-icon> &nbsp;
                                    <span v-text="'Remove All Files'"></span>
                                </v-chip>
                            </v-col> -->

                          <v-spacer></v-spacer>
                          <v-text-field
                              v-model="search"
                              append-icon="mdi-magnify"
                              label="Search"
                              single-line
                              hide-details
                          ></v-text-field>

                        </v-row>

                          <v-data-table
                          :headers="headers"
                          :items="files"
                          :search="search"
                          :footer-props="{'items-per-page-options':[31, 62, -1]}"
                          >   
                          
                            <template v-slot:item="{item, index}">
                                <tr>
                                    <td>
                                        <v-checkbox @click="addRemoveCheckItem(item, index)" :id="`select-${index+1}`"></v-checkbox>
                                    </td>
                                    <td>
                                        <span v-text="index+1"></span>
                                    </td>
                                    <td>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-btn  text v-on="on" style="text-decoration:none;" 
                                                    :download="item.fileName || ''" 
                                                    :href="'/DB_Backups/'+item.fileName || ''">
                                                    <v-icon   color="success darken-1"  v-on="on">save_alt</v-icon>
                                                </v-btn>
                                            </template>
                                            <span v-text="`Download`"></span>
                                        </v-tooltip>
        
                                        <v-tooltip top >
                                            <template v-slot:activator="{ on }">
                                                <v-btn  text v-on="on" style="text-decoration:none;" 
                                                @click="deleteFile('DB_Backups/'+item.fileName)">
                                                    <v-icon color="pink" v-on="on">delete</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Delete File?</span>
                                        </v-tooltip>
                                    </td>
                                    <td>
                                        <span v-text="item.fileName"></span>
                                    </td>
                                    <td>
                                        <span v-text="item.date"></span>
                                    </td>
                                    <td>
                                        <span v-text="getFileSizeWithPicPath('/DB_Backups/'+item.fileName)"></span>
                                    </td>

                                    
                                    
                                </tr>
                            </template>


                           
                              

                          </v-data-table>



                  </v-card-text>
              </v-card>
          </v-main>

      </v-sheet>

      


          
          <modal_alert
          :s_alert="s_alert"
          s_msg="Successfully saved!"
          :e_alert="e_alert"
          e_msg="Something went wrong!"
          :w_alert="w_alert"
          w_msg="Do you really want to proceed ?"
          :i_alert="i_alert"
          i_msg="Information "
          @cancelalert="cancelalert()"
          @cancelalertandproceed="cancelalertandproceed()"

      ></modal_alert>


   
        

    </v-app>
</div>






<script>

  var _this = this
  
  var app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    data: {
        files: [],
        search: '',
        headers: [
            { text: 'Select', value: 'Select' },
            { text: 'Id', value: 'index' },
            { text: 'Action', value: 'action' },
            { text: 'File', value: 'fileName' },
            { text: 'Date', value: 'date' },
            { text: 'Size', value: 'size' },
            
        ],

        selected: [],
    },
    mixins: [commonMixin, alertMixin],
    mounted() {
        this.getDBAutomatedBackups();
    },
    methods: {

        getDBAutomatedBackups(){
            var _this = this
    
            axios.post('/superadmin/getDBAutomatedBackups', {'X-CSRF-Token': '{{ csrf_token() }}'})
            .then(function (response) {
                _this.files = response.data.files
                _this.files = _this.objectToArray(_this.files)
            })
            .catch(function (error) {
                _this.files = []
            })
        },

        deleteFile(url=''){
            if(confirm("Do you really want to delete?")){
                var _this = this;
                axios.post('/superadmin/deleteDBBackupFile', 
                    {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                        'url' : url
                    }
                )
                .then(function (response) {
                    _this.getDBAutomatedBackups()

                    _this.s_alert = true;
                })
                .catch(function (error) {
                    _this.e_alert = true;
                })
            }
        },

        addRemoveCheckItem(item={}, index=0){
            if (this.selected.includes(item.fileName)) {
                this.selected= (this.selected).filter((i)=>{
                    return i != item.fileName
                })
            }
            else{
                this.selected.push(item.fileName)
            }
        },

        removeFiles(files=[]){
            var length = files.length

            for (let i = 0; i < length; i++) {
                files[i] = 'DB_Backups/' + files[i];
            }

            if (length>0) {
                if (confirm("Do you really wanto delete selected files?")) {
                    var _this = this;
                    axios.post('/files/batchFilesDelete', 
                        {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                            'files' : files
                        }
                    )
                    .then(function (response) {
                        _this.files=[]

                        _this.getDBAutomatedBackups()

                        _this.s_alert = true;
                    })
                    .catch(function (error) {
                        _this.e_alert = true;
                    })
                }
            }

        }
        
       

    },
    computed: {
        isSelected:function(){
            return this.selected.length>0
        }


    },

    watch: {
      
    },
    

  })
</script>

@endsection