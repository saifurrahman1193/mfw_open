@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Blog Management')
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
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script src="{{ asset('js/mixins/common.js') }}"></script>
<script src="{{ asset('js/modals/alertmixins.js') }}"></script>
<script src="{{ asset('js/modals/alert.js') }}"></script>

// pic
<script src="{{ asset('js/mixins/picture.js') }}"></script>

{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}


// zoom
<script src="{{ asset('js/zoom/zoom.js') }}"></script>
<script src="{{ asset('js/zoom/zoomMixins.js') }}"></script>



<div class="content-wrapper" style="min-height: 0px;" id="app">
  

      <v-app   >

          <v-sheet
            class=" ma-2"
            elevation="0"
            color="grey lighten-5"
        >
          
            <v-main>
                <v-card elevation="2" >
                    <v-card-title primary-title >
                        <v-spacer></v-spacer>
                        Blog Management
                        <v-spacer></v-spacer>
                    </v-card-title>

                    <v-card-text>

                        <v-row>
                            <v-dialog v-model="dialog_crud" max-width="90%" style="z-index: 100000000000000;"  @keydown.esc="close()"  @keydown.enter="crudConfirm()" persistent>
                                <template v-slot:activator="{ on }">
                                    <v-btn color="primary" dark   class="mb-2 ml-5" v-on="on" v-text="'Add a new '+formTitle"></v-btn>
                                </template>

                                <v-card >
                                    <v-card-title>
                                        <v-spacer></v-spacer>
                                        <span class="headline"> <span v-if="!editingId">Add a new </span><span v-if="editingId">Edit </span><strong v-text="formTitle"></strong></span>
                                        <v-spacer></v-spacer>
                                    </v-card-title>

                                    <v-form @submit.prevent="crudConfirm()">
                                        <v-card-text>
                                            <v-container>
                                                <v-row>
                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-text-field name="title" label="Title*" v-model="blog.title"
                                                            :rules="titleRules"
                                                            :error-messages="blogError.title"
                                                        ></v-text-field>
                                                    </v-col>

                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-text-field name="titleCN" label="Title CN" v-model="blog.titleCN"
                                                            :error-messages="blogError.titleCN"
                                                        ></v-text-field>
                                                    </v-col>

                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-text-field name="titleRU" label="Title RU" v-model="blog.titleRU"
                                                            :error-messages="blogError.titleRU"
                                                        ></v-text-field>
                                                    </v-col>

                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-textarea
                                                                label="Post* (HTML)"
                                                                v-model="blog.post"
                                                                auto-grow  outlined  rows="5"
                                                                counter
                                                                clearable
                                                                pt-2
                                                                :error-messages="blogError.post"
                                                                :rules="postRules"
                                                        ></v-textarea>
                                                    </v-col>

                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-textarea
                                                                label="Post CN (HTML)"
                                                                v-model="blog.postCN"
                                                                auto-grow  outlined  rows="5"
                                                                counter
                                                                clearable
                                                                pt-2
                                                                :error-messages="blogError.postCN"
                                                        ></v-textarea>
                                                    </v-col>

                                                    <v-col cols="12" sm="12" md="12">
                                                        <v-textarea
                                                                label="Post RU (HTML)"
                                                                v-model="blog.postRU"
                                                                auto-grow  outlined  rows="5"
                                                                counter
                                                                clearable
                                                                pt-2
                                                                :error-messages="blogError.postRU"
                                                        ></v-textarea>
                                                    </v-col>

                                                    <v-col>
                                                        <v-btn raised @click="onPickFile('photoPathInput')">Upload Image</v-btn>
                                                        <v-tooltip bottom>
                                                            <template v-slot:activator="{ on }">
                                                                    <v-btn text v-on="on" @click="cancelSingleImage($event, 'blog','photoPath')" >
                                                                        <v-icon    color="pink">cancel</v-icon>
                                                                    </v-btn>
                                                            </template>
                                                            <span>Close image</span>
                                                        </v-tooltip>
                                                        <input type="file" ref="photoPathInput"
                                                            accept="image/*"
                                                            @change="onFilePickedFromObj($event, 'blog','photoPath')" class="d-none">
                                                        <v-img v-if="blog.photoPath" :src="blog.photoPath" max-height="190" min-height="190"  aspect-ratio contain class="mt-5" ></v-img>
                                                    </v-col>

                                                    

                                                    
                                                </v-row>
                                            </v-container>
                                        </v-card-text>

                                        <v-card-actions class="mt-12">
                                            <v-spacer></v-spacer>
                                            <v-btn color="blue darken-1" text @click="close()">Cancel</v-btn>
                                            <v-btn color="blue darken-1" text type="submit">Save</v-btn>
                                        </v-card-actions>
                                    </v-form>
                                </v-card>
                            </v-dialog>

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
                            :items="blogs"
                            :search="search"
                            class="mt-3"
                            >   
                                <template v-slot:[`item.photo`]="{ item }">
                                    <v-img
                                        :src="item.photoPath || '/uploads/no_image.png'"
                                        lazy-src="/uploads/loader.gif"
                                        max-height="70"
                                        max-width="70"
                                        aspect-ratio contain
                                        @click="imageZoom(item.photoPath)"
                                        class="image-hover-cursor-change"
                                    ></v-img>
                                </template>


                                <template v-slot:[`item.action`]="{ item }">

                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-icon @click="editDialog(item.blogId)" v-on="on">edit</v-icon>
                                        </template>
                                        <span>Edit Record?</span>
                                    </v-tooltip>

                                    <!-- v-if="item.isDeletable==1" -->
                                    <v-tooltip top >
                                        <template v-slot:activator="{ on }">
                                            <v-icon @click="deleteConfirm(item.blogId)" v-on="on">delete</v-icon>
                                        </template>
                                        <span>Delete Record ?</span>
                                    </v-tooltip>

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


        <zoom_modal
            :zoomdialog="zoomdialog"
            :zoompath="zoompath"
            @cancelzoom="cancelzoom()"
        ></zoom_modal>
          
          

      </v-app>




</div>


{{-- {{ dd(Request::ip()) }} --}}


{{-- <!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script src="{{ asset('js/libraries/quilleditor.js') }}"></script> --}}



<script>

  var _this = this
  
  var app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    mixins: [commonMixin, alertMixin, pictureMixin, zoomMixin],
    components:{},

    mounted() {
      this.getBlogs()
    },
    
    
    data: {
        formTitle: 'Blog Post',
        blogs: [],
        blog: {
            title: '',
            titleCN: '',
            titleRU: '',
            post: '',
            postCN: '',
            postRU: '',
            photoPath: '',
        },
        blogError: {
            title: '',
            titleCN: '',
            titleRU: '',
            post: '',
            postCN: '',
            postRU: '',
            photoPath: '',
        },
        titleRules: [
            v => !!v || 'Title is required',
        ],
        postRules: [
            v => !!v || 'Post is required',
        ],

        search: '',
        headers: [
            {
                text: 'Blog Id',
                // align: 'start',
                // sortable: false,
                value: 'blogId',
            },
            
            { text: 'Photo', value: 'photo' },
            { text: 'Title', value: 'title' },
            { text: 'Post', value: 'post' },
            { text: 'Actions', value: 'action', sortable: false },
        ],


    },
    methods: {
      getBlogs(){
          var _this = this;
          axios.get('/api/getBlogs')
          .then(function (response) {
              _this.blogs = response.data.data;
          })
          .catch(function (error) {
          })
      },
      clearForm(){
          this.blog= {
              title: '',
              titleCN: '',
              titleRU: '',
              post: '',
              postCN: '',
              postRU: '',
              photoPath: '',
          },
          this.blogError= {
            title: '',
            titleCN: '',
            titleRU: '',
            post: '',
            postCN: '',
            postRU: '',
            photoPath: '',
          }
      },

      adding(){
          var _this=this
          axios.post('/api/addBlog', this.blog)
          .then(function (response) {
              _this.getBlogs()
              _this.s_alert = true;
              _this.dialog_crud = false
              _this.clearForm()
              _this.addingConfirmed=''
          })
          .catch(function (error) {
              _this.e_alert = true;
              _this.blogError = { title: error.response.data.title, post: error.response.data.post };
          })
      },

      deleting(){
          var _this = this;
          axios.post('/api/deleteBlog/'+this.deletingId)
          .then(function (response) {
              _this.getBlogs()

              _this.s_alert = true;
          })
          .catch(function (error) {
              _this.e_alert = true;
          })
          this.deletingId=''
      },

      setEditDialogFields(id){
          var _this = this;
          axios.get('/api/getBlog/'+id)
          .then(function (response) {
              _this.blog = response.data.data;
          })
          .catch(function (error) {
          })
      },

      editing(){
          var _this = this;
          axios.post('/api/editBlog', this.blog)
          .then(function (response) {
              _this.s_alert = true;

              _this.dialog_crud = false
              _this.getBlogs()
              _this.clearForm()
              _this.editingId=''
          })
          .catch(function (error) {
              _this.e_alert = true;
              _this.blogError = { title: error.response.data.title, post: error.response.data.post };
          })
      },


    },
    computed: {
      
    },
    watch: {
      
    },
    
  })

</script>


@endsection