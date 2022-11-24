@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])





@section('pageTitle', 'Dashboard')

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
                  <v-tabs
                  color="deep-purple accent-4"
                  show-arrows
                  >
                      <v-tab>Backups</v-tab>
                      <v-tab>Notifications</v-tab>
                      <v-tab>Language Settings</v-tab>

                      <v-tab-item>
                          <v-container fluid>
                              <v-row>
                                  <v-col  cols="auto" >
                                      <v-card elevation="2" class="text-center mx-auto py-0" width="400">
                                          <v-card-subtitle class="">
                                              Storage Backup Delete
                                              <link_processor_c :dataobject='{ name:"Delete Storage Backup", processName: "Deleting Existing Storage Backup...", link: storageBackupDeleteLink, type: "GET", color: "pink", icon : {name: "delete"}, isAlertShow:true }'></link_processor_c>

                                          </v-card-subtitle>
                                      </v-card>
                                  </v-col>

                                  <v-col  cols="auto" >
                                      <v-card elevation="2" class="text-center mx-auto py-0" width="400">
                                          <v-card-subtitle class="">
                                              Download Storage Backup 
                                              <br>
                                              {{-- <link_processor_c :dataobject='{ name:"Generate Storage Backup", processName: "Generating Storage Backup...", link: storageBackupDownloadLink, type: "GET", color: "success", icon : {name: "cloud_download"}, isAlertShow:true, downloadLink: "/storage_backup.zip" }'></link_processor_c> --}}
                                              {{-- <a href="{{ route('storageBackup') }}" download class="storage_backup_indicator">Generate Storage Backup and Download</a> --}}
                                              <a href="{{ route('storageBackup') }}" download class="storage_backup_indicator">Generate Storage Backup and Download</a>
                                          </v-card-subtitle>
                                      </v-card>
                                  </v-col>
                              </v-row>
                          </v-container>

                          <v-container fluid>
                            <v-row>
                                <v-col  cols="auto" >
                                    <v-card elevation="2" class="text-center mx-auto py-0" width="400">
                                        <v-card-subtitle class="">
                                            DB Backup Delete
                                            <link_processor_c :dataobject='{ name:"Delete DB Backup", processName: "Deleting Existing DB Backup...", link: dbBackupDeleteLink, type: "GET", color: "pink", icon : {name: "delete"}, isAlertShow:true }'></link_processor_c>

                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>

                                <v-col  cols="auto" >
                                    <v-card elevation="2" class="text-center mx-auto py-0" width="400">
                                        <v-card-subtitle class="">
                                            Download DB Backup 
                                            <link_processor_c :dataobject='{ name:"Generate DB Backup", processName: "Generating DB Backup...", link: dbBackupDownloadLink, type: "GET", color: "success", icon : {name: "cloud_download"}, isAlertShow:true, downloadLink: "/server_db_backup.sql" }'></link_processor_c>

                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-container>
                      </v-tab-item>

                      <v-tab-item>
                          <v-container fluid>
                              <v-row>
                                <v-col  cols="auto" >
                                  <v-card elevation="2" class="text-center mx-auto py-0" width="400">
                                      <v-card-subtitle class="">
                                        Notifications
                                        <table class="table table-striped table-bordered table-hover ">
                                          <tr>
                                            <th>Read At Admin All Notifications</th>
                                            <th>
                                              <form  method="post" action="{{ route('readatadminallnotifications') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                                  {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <a>
                                                      <button type="submit" value="PUT" class="btn btn-link" >
                                                        <i class="fa fa-check text-success fa-lg tooltipster" style="font-size:25px; color:red" title="Read At Admin All Notifications?"></i>
                                                      </button>
                                                    </a>
                                              </form>
                                            </th>
                                          </tr>
                      
                      
                                          <tr>
                                            <th>Read At All Customers Notifications</th>
                                            <th>
                                              <form  method="post" action="{{ route('readatallcustomersallnotifications') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                                  {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <a>
                                                      <button type="submit" value="PUT" class="btn btn-link" >
                                                        <i class="fa fa-check text-success fa-lg tooltipster" style="font-size:25px; color:red" title="Read At All Customers Notifications?"></i>
                                                      </button>
                                                    </a>
                                              </form>
                                            </th>
                                          </tr>
                      
                                        </table>
                                      </v-card-subtitle>
                                    </v-card>
                                </v-col>
                              </v-row>
                          </v-container>
                      </v-tab-item>

                      <v-tab-item>
                          <v-container fluid>
                              <v-row>
                                <v-col  cols="auto" >
                                    <v-card elevation="2" class="text-center mx-auto py-0" width="400">
                                        <v-card-subtitle class="">
                                          Language Settings
                                          
                                          <table class="table table-striped table-bordered table-hover ">
                                            @foreach (DB::table('languagesettings')->get() as $languagesetting)
                                                <tr>
                                                  <th>{{$languagesetting->language}}</th>
                                                  <th >
                                                        <a href="{{ route('languageOnOffSettings', ['languageId'=>$languagesetting->languagesettingsId, 'onOffId'=>$languagesetting->isOn]) }}"
                                                          class="{{ $languagesetting->isOn ? 'text-success' : 'text-danger' }}" >
                                                          {{$languagesetting->isOn ? 'On' : 'Off'}}
                                                        </a>
                                                  </th>
                                                </tr>
                                            @endforeach
                                          </table>

                                        </v-card-subtitle>
                                    </v-card>
                                </v-col>
                              </v-row>
                          </v-container>
                      </v-tab-item>

                      

                  </v-tabs>
              </v-card>

              <v-divider></v-divider>
              
              <v-card elevation="0" class="mt-5" >
                <v-container fluid >
                    <v-row>

                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Admin', highlightedData: { text: numberWithCommas(dashboardData.totalAdmin)||'0', explaination: 'Total admin' } 
                          }"
                        />
                      </v-col>

                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Customers', highlightedData: { text: numberWithCommas(dashboardData.totalCustomers)||'0', explaination: 'Total customers without admin dashboard access.' } ,
                          lists: [
                            {key: '<b>Email Verified</b>', value: numberWithCommas(dashboardData.totalCustomersEmailVerified) || 0 },
                            {key: '<b>Email Not Verified</b>', value: numberWithCommas(dashboardData.totalCustomers-dashboardData.totalCustomersEmailVerified) || 0 },
                            {key: '<b>Created By Admin</b>', value: numberWithCommas(dashboardData.totalCustomersCreatedByAdmin) || 0 },
                            {key: '<b>Disabled</b>', value: numberWithCommas(dashboardData.totalCustomersDisabled) || 0 },
                            
                          ]}"
                        />
                      </v-col>

                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Orders', highlightedData: { text: numberWithCommas(dashboardData.totalOrders)||'0', explaination: 'Total number of placed orders.' } , 
                          lists: [
                            {key: '<b>Pending</b>', value: numberWithCommas(dashboardData.totalOrdersPending) || 0 },
                            {key: '<b>Approved</b>', value: numberWithCommas(dashboardData.totalOrdersApproved) || 0 },
                            {key: '<b>Rejected</b>', value: numberWithCommas(dashboardData.totalOrdersRejected) || 0 },
                            {key: '<b>Payment Confirm</b>', value: numberWithCommas(dashboardData.totalOrdersPaid) || 0 },
                            {key: '<b>Shipping</b>', value: numberWithCommas(dashboardData.totalOrdersInShipping) || 0 },
                            {key: '<b>Complete</b>', value: numberWithCommas(dashboardData.totalOrdersComplete) || 0 },
                          ]}"
                        />
                      </v-col>

                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Sale', highlightedData: { text: '$ '+(numberWithCommas(dashboardData.totalSale)||0)}, 
                                      lists: [
                                        {key: '<b>Payment Confirm</b>', value: '$ '+(numberWithCommas(dashboardData.totalSalePaymentConfirm) || 0) },
                                        {key: '<b>Average</b>', value: '$ '+(numberWithCommas(dashboardData.avgSale) || 0) }
                                      ] }"
                        />
                      </v-col>

                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Generic Brands', highlightedData: { text: (numberWithCommas(dashboardData.totalGenericBrands)||'0'), explaination: 'Total generic brands added in the system.'}, 
                          lists: [
                                  {key: '<b>Generic Brands Visible</b>', value: (numberWithCommas(dashboardData.totalGenericBrandsFrontendVisible) || 0) },
                                  {key: '<b>Generic Brands Invisible</b>', value: (numberWithCommas(dashboardData.totalGenericBrands-dashboardData.totalGenericBrandsFrontendVisible) || 0) },
                                  {key: '<b>Total Generic Packages</b>', value: (numberWithCommas(dashboardData.totalGenericPackSizes) || 0) },
                                  {key: '<b>Total User Generic Inquiry</b>', value: (numberWithCommas(dashboardData.totalUserGenericInquiry) || 0) },
                                ]}"
                        />
                      </v-col>


                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Blog Posts', highlightedData: { text: (numberWithCommas(dashboardData.totalBlogPosts)||'0'), explaination: 'Total blog posts added in the system.'}}"
                        />
                      </v-col>

                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Product Reviews', highlightedData: { text: (numberWithCommas(dashboardData.totalReviews)||'0'), explaination: 'Total product reviews added by the customers.'}, 
                          lists: [
                                  {key: processTitleStyleBoldColor('Pending', false, '#E91E63'), value: (numberWithCommas(dashboardData.totalReviews-dashboardData.totalReviewsApproved) || 0) },

                                  {key: processTitleStyleBoldColor('Approved', false, '#00C853'), value: (numberWithCommas(dashboardData.totalReviewsApproved) || 0) },
                                ]
                          }"
                        />
                      </v-col>


                      <v-col  cols="auto" >
                        <dashboard_small_card_c 
                          :dataobject="{title: 'Total Admin Notifications', highlightedData: { text: (numberWithCommas(dashboardData.totalNotifications)||'0'), explaination: 'Total admin notifications.'},
                          lists: [
                                  {key: processTitleStyleBoldColor('Read At', false, '#00C853'), value: (numberWithCommas((dashboardData.totalNotifications||0)-(dashboardData.totalNotificationsNotReadAt||0)) || 0) },
                                  {key: processTitleStyleBoldColor('Not Read At', false, '#E91E63'), value: (numberWithCommas(dashboardData.totalNotificationsNotReadAt) || 0) }
                                ]
                          }"
                        />
                      </v-col>

                      
                    </v-row>

                    <v-row>
                      <v-col  cols="auto"  sm="12" md="6">
                        <v-card elevation="2" class="text-center mx-auto py-0" >
                          <v-card-subtitle class="text-center">Sales by Category</v-card-subtitle>
                          <pie-chart :data="salesByCategoryPieChartData" v-if="(salesByCategoryPieChartData||[]).length>0"></pie-chart>
                          <v-chip class="ma-5" small   v-else> Found no data!</v-chip>
                        </v-card>
                      </v-col>


                      <v-col  cols="auto"  sm="12" md="6">
                        <v-card elevation="2" class="text-center mx-auto py-0" >
                          <v-card-subtitle class="text-center">Sales by Disease Category</v-card-subtitle>
                          <pie-chart :data="salesByDiseaseCategoryPieChartData" v-if="(salesByDiseaseCategoryPieChartData||[]).length>0"></pie-chart>
                          <v-chip class="ma-5" small   v-else> Found no data!</v-chip>
                        </v-card>
                      </v-col>
                    </v-row>
                </v-container>
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

      this.getDashboardData()
      this.getSalesByDiseaseCategory()
      this.getSalesByCategory()
        
    },
    
    data: {
        storageBackupDeleteLink: '{{ route('storageBackupDelete') }}',
        storageBackupDownloadLink: '{{ route('storageBackup') }}',

        dbBackupDeleteLink: '{{ route('serverDBBackupDelete') }}',
        dbBackupDownloadLink: '{{ route('serverDBBackup') }}',


        dashboardData: {},

        salesByDiseaseCategory:[],
        salesByDiseaseCategoryPieChartData:[],

        salesByCategoryPieChartData: [],
        salesByCategory: [],
        
        
    },
    methods: {
      getDashboardData(){
          var _this=this
          axios.get('/dashboard/dashboardData', {'X-CSRF-Token': '{{ csrf_token() }}'})
          .then(function (response) {
              _this.dashboardData=response.data.data
          })
          .catch(function (error) {
            _this.dashboardData={}
          })
      },

      getSalesByDiseaseCategory(){
        var _this=this
        axios.get('/dashboard/getSalesByDiseaseCategory', {'X-CSRF-Token': '{{ csrf_token() }}'})
        .then(function (response) {
            _this.salesByDiseaseCategory=response.data.data

            _this.salesByDiseaseCategory.forEach(function(row){
                _this.salesByDiseaseCategoryPieChartData.push([row.diseaseCategory, row.amount])
            });
        })
        .catch(function (error) {
          _this.salesByDiseaseCategory=[]
        })
      },

      getSalesByCategory(){
        var _this=this
        axios.get('/dashboard/getSalesByCategory', {'X-CSRF-Token': '{{ csrf_token() }}'})
        .then(function (response) {
            _this.salesByCategory=response.data.data

            _this.salesByCategory.forEach(function(row){
                _this.salesByCategoryPieChartData.push([row.category, row.amount])
            });
        })
        .catch(function (error) {
          _this.salesByCategory=[]
        })
      },
        

    },
    computed: {
      
    },
    watch: {
      
    },
    
  })

</script>


<style>
  .storage_backup_indicator:hover{
    text-decoration: underline;
  }
  .storage_backup_indicator:active, .storage_backup_indicator:focus {
    color: darkgray;
    text-decoration: underline;
  }
</style>

@endsection

