@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Sitemap')


<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet" >
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"   rel="stylesheet" >
<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet" >

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

<script src="{{ asset('js/components/readmoreless.js') }}"></script>



{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}



{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60" id="app" >

    <v-app >

        <v-sheet
            elevation="0"
        >
                <v-card elevation="0" >
                    <v-card-title primary-title class="title-text">
                        <v-spacer></v-spacer>
                        {{ __('blog.blog') }}
                        <v-spacer></v-spacer>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <v-autocomplete
                                        label="{{ __('blog.showresultperpage') }}"
                                        v-model="paginateNumber"
                                        :items="showResults"
                                        item-text="key"
                                        item-value="key"
                                        @change="getBlogsWithPaginate()"
                            ></v-autocomplete>
                            <v-spacer></v-spacer>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="{{ __('blog.search') }}..."
                                single-line
                                hide-details
                                @change="getBlogsWithPaginate()"
                            ></v-text-field>
                        </v-row>
                    </v-card-text>
                </v-card>


                <v-card-title primary-title class="title-text" v-if="blogs.length==0">
                    <v-spacer></v-spacer>
                    {{ __('blog.nopostfound') }}
                    <v-spacer></v-spacer>
                </v-card-title>

                

                <v-row class="mt-12 mx-2" >
                    <v-col  xs="12" sm="12"   md="12"   >
                        <v-card elevation="2"
                            v-for="blog in blogs || [] "
                            :key="blog.blogId"
                            class="mb-3 pa-2"
                        >
                            <v-row v-if="blog.photoPath">
                                <v-spacer></v-spacer>
                                <v-img  :src="blog.photoPath" 
                                :height="isSMALT ? 200 : 300"  aspect-ratio contain
                                ></v-img>
                                <v-spacer></v-spacer>
                            </v-row>

                            <v-card-title v-html="blog.title" class="card-title-text"></v-card-title>

                            <v-card-text  class="card-text " style="text-align: justify;">
                                <readmoreless_c :text="blog.post"></readmoreless_c>
                                
                            </v-card-text>
                            
                            {{--  v-html="blog.post"  --}}
                            

                        </v-card>
                    </v-col>
                </v-row>

                <v-row justify="center" >
                    <v-col >
                        <v-container class="max-width">
                            <v-list >
                                <v-list-item v-for="i in blog_length_d" :key="i" class="d-inline-block pa-0 mx-1 " >
                                    <v-btn small class="pa-0 card-text" @click="getBlogsWithPaginate(i)"
                                    :class="blog_current_page_d==i? 'green white--text ':''"
                                     v-text="i"></v-btn>
                                </v-list-item>
                            </v-list>
                        </v-container>
                    </v-col>
                </v-row>


        </v-sheet>

        
    </v-app>
</div>




<script>

    var _this = this

    var app = new Vue({
        vuetify: new Vuetify(),
        el: '#app',
        mixins: [commonMixin],
        components:{},

        mounted() {
            this.getBlogsWithPaginate();
        },
        
        
        data: {
            paginateNumber: 10,
            blogs: [],
            blog_current_page_d: '',
            blog_length_d: '',
            search: '',
            showResults: [
                {'key': 10},
                {'key': 20},
                {'key': 50},
                {'key': 100},
                {'key': 500},
            ]

        },
        methods: {

            getBlogsWithPaginate(page=1){
                var _this = this;
                axios.get('/api/getBlogsWithPaginate/'+'{{ app()->getLocale() }}/'+this.paginateNumber+'?page='+page+'&search='+this.search)
                .then(function (response) {
                    _this.blogs = response.data.data.blogs
                    _this.blog_current_page_d =  response.data.data.paginationData.current_page
                    _this.blog_length_d =  response.data.data.paginationData.last_page
                })
                .catch(function (error) {
                })
            },

         

        },
        computed: {
      
        },
        watch: {
          
        },
        
    })
    
</script>



<style >
    .v-autocomplete__content.v-menu__content {
        top: 0px !important;
        left: 0px !important;
        margin-top: 0px !important;
    }

    #search-category-id{
        background: white !important;
    }
</style>

@endsection
