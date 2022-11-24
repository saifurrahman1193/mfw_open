@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Block List Management')

@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"   rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">



@if ( preg_match("/127.0/", Request::ip()) )
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
@else
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.min.js"></script>
@endif
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script src="{{ asset('js/mixins/common.js') }}"></script>
<script src="{{ asset('js/modals/alertmixins.js') }}"></script>
<script src="{{ asset('js/modals/alert.js') }}"></script>
<script src="{{ asset('js/components/lists.js') }}"></script>



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
                      Block List Management
                      <v-spacer></v-spacer>
                  </v-card-title>

                  <v-card-text>

                        <v-row class="mb-2">
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
                            :items="blockPersons"
                            :search="search"
                            :footer-props="{'items-per-page-options':[30, 50, 100, 500, -1]}"

                            :custom-filter="customFilter"
                            >   
                            
                            <template v-slot:item="{item, index}">
                                <tr>
                                    <td>
                                        <span v-text="index+1"></span>
                                    </td>

                                    <td>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-icon color="success" v-on="on" @click="unblockAPerson(item)" >how_to_reg</v-icon>
                                            </template>
                                            <span>Unblock this person from all section?</span>
                                        </v-tooltip>
                                    </td>

                                    <td>
                                        <lists_c
                                            :lists="[
                                                {key: '<b>Blocked Person</b>', value: '' },
                                                {key: processContactWithReviewerRequesterLink(item), value: '' },
                                                {key: item.email, value: '' },
                                                {key: item.phone, value: '' },
                                                {key: customerDataReportGenerator(item.userId), value: '' },
                                                
                                            ]"
                                        ></lists_c>
                                    </td>

                                    <td>
                                        <v-chip :color="item.userId ? 'success': 'pink'" small  dark v-text="item.userId ? 'Registered': 'Unregistered'"></v-chip>
                                    </td>

                                    <td>
                                        <lists_c
                                            :lists="getSinglePersonReasons(item.email) || []"
                                            @block_list_data="block_list_data"
                                        ></lists_c>
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
        search: '',
        headers: [
            {
                text: 'Id',
                value: 'index'
            },
            { text: 'Actions', value: 'action', sortable: false },
            {
                text: 'Block Person',
                value: 'block_person',
            },
            {
                text: 'Registered?',
                value: 'registered',
            },
            {
                text: 'Block Sections',
                value: 'block_sections',
            },
            
            
        ],
        blockPersons: [],
        blockReasons: [],
    },
    mixins: [commonMixin, alertMixin],
    mounted() {
        this.block_list_data()
    },
    methods: {
        block_list_data(){
            var _this=this
            axios.post('/superadmin/block_list_data', {'X-CSRF-Token': '{{ csrf_token() }}'})
            .then(function (response) {
                _this.blockPersons = response.data.blockPersons
                _this.blockReasons = response.data.blockReasons
            })
            .catch(function (error) {
                _this.blockPersons = []
                _this.blockReasons = []
            })
        },

        processContactWithReviewerRequesterLink(obj = {}){
            if(obj.userId){
                return `<a target='_blank' href='${'/customers/customerProfileUpdate/'+obj.userId}'>${obj.name}</a>`;
            }
            else{
                return `${obj.name}`;
            } 
            
        },

        getSinglePersonReasons(email='')
        {
            var arr = []
            
            var i = 0
            this.blockReasons.forEach(blockReason => {
                if (blockReason.email==email)
                {
                    i++
                    if (i==1)
                    {
                        arr.push({ key: '#', value: '<b>Block Sections</b>', action: {actionText:'Action' } })
                    }
                    arr.push({ key: i+'.', value: blockReason.description+'<br>'+'<b style="font-size: 12px;">'+this.datetimeprocessing(blockReason.created_at)+'</b>', action:{icon: 'how_to_reg', iconColor: 'success', tooltip: 'Unblock this action', postData: { url: '/superadmin/unblockAPersonWBlockTypeId','token': '{{ csrf_token() }}' , dataObj: { email: blockReason.email, blockTypeId: blockReason.blockTypeId } , emit:'block_list_data'}  } })
                }
            });
            
            return arr;
        },

        getSinglePersonDescriptionsPlain(email='')
        {
            var str = '';
            this.blockReasons.forEach(blockReason => {
                if (blockReason.email==email)
                {
                    str+=' '+blockReason.description+' '+this.datetimeprocessing(blockReason.created_at)
                }
            });
            return str;
        },

        unblockAPerson(obj={}){
            var _this=this
            if(confirm("Do you really want to proceed?")){
                axios.post('/superadmin/unblockAPerson', {'postData': obj,'X-CSRF-Token': '{{ csrf_token() }}'})
                .then(function (response) {
                    _this.block_list_data()
                    _this.s_alert=true
                })
                .catch(function (error) {
                    _this.e_alert=true
                })
            }
        },

        customFilter(value, search, item){
            if(search ){

                {{--  console.log('called')
                console.log('value = ', value)
                console.log('search')
                console.log(search)
                console.log('item')
                console.log(item) 
                console.log(item)  --}}


                totalSearchItemString = this.string_concat(' ',[item.name, item.email, item.phone, this.getSinglePersonDescriptionsPlain(item.email)])

                {{--  console.log('totalSearchItemString = ')
                console.log(totalSearchItemString)  --}}
    
                return totalSearchItemString.toString().toLowerCase().indexOf(search) !== -1
            }
        }
    },
    computed: {

    },

    watch: {
      
    },
  })
</script>

@endsection