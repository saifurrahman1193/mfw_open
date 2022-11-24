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
{{-- <script src="{{ asset('js/google_chart_loader.js') }}"></script> --}}


<div class="content-wrapper" style="min-height: 0px;"   >
  <v-app color="grey lighten-5" id="app">
    <v-sheet
          class=" ma-2"
          elevation="0"
      >
      <v-content color="grey lighten-5">

          <template >
              <v-card elevation="0" >
                <v-container fluid >
                    <v-row align="center" justify="center">                      
                        <h1 style="text-align: center">Welcome to Medicine For World Admin panel</h1><br> 
                    </v-row >
                    <v-row align="center" justify="center">                      
                      <p style="text-align: center">Click in the link below to Check out our admin guide</p><br>
                    </v-row>
                    <v-row align="center" justify="center">                      
                      <a style="text-align: center" href="https://drive.google.com/drive/folders/1sNoMYUwcRMOvkKOYp4g_-O-H8poQ0lOQ?usp=sharing" target="_blank">
                        <v-btn elevation="2">Admin Panel Guide</v-btn>
                      </a>
                    </v-row>
                    
                </v-container>
              </v-card>
          </template>
      </v-content>

    </v-sheet>

  <v-spacer></v-spacer>

  </v-app>

</div>

{{-- https://chartkick.com/vue --}}

<script>
  var _this = this
  
  var app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    mixins: [commonMixin, algorithmMixin,  alertMixin],
    components:{  },
    mounted() {
      
    },
    data: {
        
    },
    methods: {
       

        
    },
    computed: {
      
    },
    watch: {
      
    },
  })

  
</script>


@endsection