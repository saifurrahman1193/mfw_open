<!DOCTYPE html>


@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])





@section('pageTitle', 'Log Management')

@section('page_content')


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
{{--  <script src="{{ asset('js/vue-router.js') }}"></script>  --}}

<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
{{-- chart --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
<script src="https://unpkg.com/vue-chartkick@0.5.0"></script>

<script src="{{ asset('js/axios.min.js') }}"></script>

<script src="{{ asset('js/mixins/common.js') }}"></script>
<script src="{{ asset('js/mixins/algorithms.js') }}"></script>
<script src="{{ asset('js/modals/alertmixins.js') }}"></script>
<script src="{{ asset('js/modals/alert.js') }}"></script>

{{--  pic  --}}
<script src="{{ asset('js/mixins/picture.js') }}"></script>

{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}


{{--  components  --}}
<script src="{{ asset('js/components/lists.js') }}"></script>
<script src="{{ asset('js/components/linkprocessor.js') }}"></script>
<script src="{{ asset('js/components/dashboardsmallcard.js') }}"></script>

<script src="{{ asset('js/components/logdatatable.js') }}"></script>





<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/google_chart_loader.js') }}"></script>

<style type="text/css" media="screen">

    a{
          text-decoration: none;
          color: black;
    }
    a:hover{
          text-decoration: none;
    }
    .card img{
      max-width: 154px;
    }
    .card-title{
      text-align: center;
    }
</style>


<div class="content-wrapper" style="min-height: 0px;"   id="app">
  <v-app>
    <v-sheet
          class=" ma-2"
          elevation="0"
          
      >
      <v-content >

          <template>
              <v-card elevation="0">

                  <v-card-title primary-title >
                      <v-spacer></v-spacer>
                      Log Management
                      <v-spacer></v-spacer>
                  </v-card-title>

                  <v-tabs
                  color="deep-purple accent-4"
                  show-arrows
                  >
                      <v-tab>DB Backup Secheduler</v-tab>
                     
                      <v-tab-item>
                          <v-container fluid>
                              <v-row>
                                  <logdatatable_c  :logdata="db_backup_scheduler_log"  />
                              </v-row>
                          </v-container>
                      </v-tab-item>
                      

                  </v-tabs>
              </v-card>

          </template>
      </v-content>

    </v-sheet>

  <v-spacer></v-spacer>

  </v-app>

</div>




<script>

  var _this = this
  
  var app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    mixins: [commonMixin, algorithmMixin,  alertMixin],
    components:{},

    mounted() {
        this.getLogData('db_backup_scheduler_log')
    },
    
    data: {
        db_backup_scheduler_log: [],
    },
    methods: {
        getLogData(logName){
            var _this=this
            axios.post('/superadmin/getLogData/'+logName, {'X-CSRF-Token': '{{ csrf_token() }}'})
            .then(function (response) {
                _this[logName]=response.data.data

                
                _this[logName] = _this.arrayOfObjectSortDesc(_this[logName], 'line')
                _this.setLogLineStringToObject(logName)
            })
            .catch(function (error) {
                _this[logName]=[]
            })
        },

        setLogLineStringToObject(logName){

            console.log('==================================')

            console.log(this[logName].length)


            for (let i = 0; i < this[logName].length; i++) {
                this[logName][i].content = JSON.parse(this[logName][i].content);

                console.log(this[logName][i].content)
            }
            console.log('==================================')

        }
        

    },
    computed: {
      
    },
    watch: {
      
    },
    
  })

</script>


@endsection

