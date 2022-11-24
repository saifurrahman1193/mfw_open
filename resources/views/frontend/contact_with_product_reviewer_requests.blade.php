@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Contact with product reviewer requests')
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
<script src="{{ asset('js/axios.min.js') }}"></script>

<script src="{{ asset('js/mixins/common.js') }}"></script>
<script src="{{ asset('js/mixins/algorithms.js') }}"></script>
<script src="{{ asset('js/modals/alertmixins.js') }}"></script>
<script src="{{ asset('js/modals/alert.js') }}"></script>

{{--  pic  --}}
<script src="{{ asset('js/mixins/picture.js') }}"></script>

{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}


{{--  zoom  --}}
<script src="{{ asset('js/zoom/zoom.js') }}"></script>
<script src="{{ asset('js/zoom/zoomMixins.js') }}"></script>

{{--  components  --}}
<script src="{{ asset('js/components/lists.js') }}"></script>



<div class="content-wrapper" style="min-height: 0px;" id="app">
  
      <v-app>

          <v-sheet
            class=" ma-2"
            elevation="0"
            color="grey lighten-5"
        >
          
            <v-main>
                <v-card elevation="0" >
                    <v-card-title primary-title >
                        <v-spacer></v-spacer>
                        Contact with product reviewer requests
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
                            :items="requests_data"
                            :search="search"
                            :footer-props="{'items-per-page-options':[30, 50, 100, 500, -1]}"

                            :custom-filter="customFilter"
                            >   
                            
                              <template v-slot:item="{item, index}">
                                  <tr>
                                        <td>
                                            <span v-text="item.contact_w_reviewer_req_id"></span>
                                        </td>
                                        <td>

                                            
                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-icon   color="primary"  v-on="on" @click="send_mail_dialog=true; send_mail_dialog_data_set(item.contact_w_reviewer_req_id, item.reviewId, item.requesterName, item.requesterEmail)">forward_to_inbox</v-icon>
                                                </template>
                                                <span>Send Mail</span>
                                            </v-tooltip>

                                            <v-tooltip top>
                                                <template v-slot:activator="{ on }">
                                                    <v-icon color="pink" v-on="on" @click="contact_with_product_reviewer_request_delete(item)" >delete</v-icon>
                                                </template>
                                                <span>Delete Record?</span>
                                            </v-tooltip>

                                            <v-tooltip top v-if="!(item.isBlocked==1)">
                                                <template v-slot:activator="{ on }">
                                                    <v-icon color="red" v-on="on" @click="block_a_person_by_mail(item.requesterName,item.requesterEmail)" >block</v-icon>
                                                </template>
                                                <span>Block this person?</span>
                                            </v-tooltip>

                                            

                                            <v-chip v-if="(item.isMailSent||0)==1" color="success" outlined small>Mail already sent</v-chip>
                                            <v-chip v-if="item.isBlocked==1" :color="item.isBlocked==1 ? 'pink': ''" outlined small>Blocked</v-chip>
                                            

                                        </td>
                                        <td>
                                            <lists_c
                                                :lists="[
                                                    {key: '<b>Requester</b>', value: '' },
                                                    {key: processContactWithReviewerRequesterLink(item), value: '' },
                                                    {key: item.requesterEmail, value: '' },
                                                    {key: datetimeprocessing(item.created_at), value: '' },
                                                    {key: customerDataReportGenerator(item.requesterId), value: '' },
                                                    
                                                ]"
                                            ></lists_c>
                                        </td>

                                        <td>
                                            <v-chip :color="item.requesterId ? 'success': 'pink'" small  dark v-text="item.requesterId ? 'Registered': 'Unregistered'"></v-chip>
                                        </td>

                                        <td>
                                            <lists_c
                                                :lists="[
                                                    {key: '<b>Reviewer</b>', value: '' },
                                                    {key: item.reviewerName, value: '' },
                                                    {key: item.reviewerPhoneCode+item.reviewerPhone, value: '' },
                                                    {key: item.reviewerEmail, value: '' },
                                                ]"
                                            ></lists_c>
                                        </td>
                                        <td>
                                            <lists_c
                                                :lists="[
                                                    {key: '<b>Product Details</b>', value: '' },
                                                    
                                                    {key: `<a target='_blank' href='${'/en/productDetailsPageCaller/'+item.genericBrandId}'>${item.genericBrand}</a>`, value: '' },
                                                ]"
                                                {{--  {key: `<img style='max-width:70px;' src='${item.genericBrandPicPath}' @click='imageZoom(${item.genericBrandPicPath})'> `, value: '' },  --}}
                                            ></lists_c>
                                            <v-img
                                                :src="item.genericBrandPicPath || '/uploads/no_image.png'"
                                                lazy-src="/uploads/loader.gif"
                                                max-height="70"
                                                max-width="70"
                                                aspect-ratio contain
                                                @click="imageZoom(item.genericBrandPicPath || '/uploads/no_image.png')"
                                                class="image-hover-cursor-change"
                                            ></v-img>
                                        </td>
                                        <td>
                                            <lists_c
                                                :lists="[
                                                    {key: 'Rating', value: numberWithCommas(item.rating||0)},
                                                    {key: item.comment, value: '' },
                                                    
                                                ]"
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
            w_msg="Do you really want to proceed?"
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

        <v-dialog   max-width="90%" style="z-index: 100000000000000;" persistent  scrollable  v-model="send_mail_dialog"  >
            <v-card>
                <v-form @submit.prevent="send_mail_dialog_confirm()">
                    <v-card-title>
                        <v-spacer></v-spacer>
                            <span class="headline">Send Mail</span>
                        <v-spacer></v-spacer>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-autocomplete
                                        label="Email Body Title"
                                        :items="mailData"
                                        item-text="emailBodyTitle"
                                        item-value="emailBodyId"
                                        dense
                                        v-model="send_mail.emailBodyId"
                                        filled
                                        @change="processBody"
                                    ></v-autocomplete>
                                </v-col>

                                <v-col cols="12" sm="12" md="12">
                                    <v-textarea
                                            label="Email Body (HTML)*"
                                            v-model="send_mail.emailBody"
                                            auto-grow  outlined  rows="5"
                                            counter
                                            clearable
                                            pt-2
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions class="mt-12">
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="close_send_mail_dialog" v-if="!send_mail.isLoading">Cancel</v-btn>

                        

                        <v-chip color="orange" outlined
                            v-if="send_mail.isLoading"
                        >  Sending Mail... &nbsp;
                            <v-progress-circular
                                indeterminate
                                color="orange"
                                size="20"
                            ></v-progress-circular>
                        </v-chip>

                        <v-btn
                            color="primary"
                            class="ma-2 white--text text-capitalize"
                            large
                            type="submit"
                            v-else
                            >
                            Send Mail
                            <v-icon >chevron_right</v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-form>

            </v-card>
        </v-dialog>

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
    mixins: [commonMixin, algorithmMixin,  alertMixin, pictureMixin, zoomMixin],
    components:{},

    mounted() {
        this.contact_with_product_reviewer_requests_data();
        
    },
    
    data: {
        search: '',
        requests_data: [],
        headers: [
            {
                text: 'Id',
                value: 'contact_w_reviewer_req_id'
            },
            { text: 'Actions', value: 'action', sortable: false },
            {
                text: 'Requester',
                value: 'requester',
            },
            {
                text: 'Registered?',
                value: 'registered',
            },

            {
                text: 'Product Reviewer',
                value: 'product_reviewer',
            },

            {
                text: 'Product Details',
                value: 'product_details',
            },

            {
                text: 'Review',
                value: 'review',
            },
            
            
        ],

        {{--  send_mail_dialog  --}}
        send_mail_dialog: false,
        send_mail: {emailBody: '', isLoading: false},
        mailData:[],

        {{--  query params  --}}
        contact_with_product_reviewer_request: '',
        contact_with_product_reviewer_requesterId: '',
        reviewId: '',
        
        
    },
    methods: {

        block_a_person_by_mail(name='', email=''){
            var _this=this
            if(email.length>3){
                if( confirm("Do you really want to proceed?")){
                    axios.post('/customers/block_a_person_by_mail', {'postData' : {'name': name,'email': email,'reason': 'Contact with product reviewer requests', 'blockTypeId': 2}, 'X-CSRF-Token': '{{ csrf_token() }}'})
                    .then(function (response) {
                        _this.contact_with_product_reviewer_requests_data()
                        _this.s_alert=true
                    })
                    .catch(function (error) {
                        _this.e_alert=true
                    })
                }
                
            }
        },

        contact_with_product_reviewer_request_delete(obj={}){
            var _this=this
            if(confirm("Do you really want to proceed?")){
                axios.post('/customers/contact_with_product_reviewer_request_delete', {'postData': obj,'X-CSRF-Token': '{{ csrf_token() }}'})
                .then(function (response) {
                    _this.contact_with_product_reviewer_requests_data()
                    _this.s_alert=true
                })
                .catch(function (error) {
                    _this.e_alert=true
                })
            }
        },
      
        contact_with_product_reviewer_requests_data(){
            var _this=this
            axios.post('/customers/contact_with_product_reviewer_requests_data', {'X-CSRF-Token': '{{ csrf_token() }}'})
            .then(function (response) {
                _this.requests_data = response.data.data
                _this.mailData=response.data.mailData

                _this.requests_data = _this.arrayOfObjectSortDesc(_this.requests_data, 'contact_w_reviewer_req_id', true)

                _this.queryParamsLoader()
            })
            .catch(function (error) {
                _this.requests_data = []
                _this.mailData=[]
            })
        },

        processContactWithReviewerRequesterLink(obj = {}){
            if(obj.requesterId){
                return `<a target='_blank' href='${'/customers/customerProfileUpdate/'+obj.requesterId}'>${obj.requesterName}</a>`;
            }
            else{
                return `${obj.requesterName}`;
            } 
            
        },

        {{--  send_mail_dialog  --}}
        close_send_mail_dialog(){
            this.send_mail = {emailBody: '', isLoading: false}

            this.send_mail_dialog = false
        },
        processBody(){
            this.send_mail.emailBody = this.mailData.filter((mail) => {
                return mail.emailBodyId==this.send_mail.emailBodyId
            }).map((item)=>{
                return item.emailBody
            })[0]
        },

        send_mail_dialog_confirm(){
            var _this=this
            if(confirm("Do you really want to proceed?")){
                this.send_mail.isLoading=true
                
                axios.post('/customers/contact_with_product_reviewer_requests_mail_send', {'postData': this.send_mail, 'X-CSRF-Token': '{{ csrf_token() }}'})
                .then(function (response) {
                    _this.contact_with_product_reviewer_requests_data()
                    _this.send_mail.isLoading=false
                    _this.send_mail_dialog=false
                    _this.send_mail_clear()
                })
                .catch(function (error) {
                    _this.send_mail.isLoading=false
                    _this.e_alert = true;
                })

            }
        },

        send_mail_dialog_data_set(contact_w_reviewer_req_id, reviewId, requesterName, requesterEmail)
        {
            console.log(contact_w_reviewer_req_id)
            this.send_mail.contact_w_reviewer_req_id = contact_w_reviewer_req_id
            this.send_mail.reviewId = reviewId
            this.send_mail.requesterName = requesterName
            this.send_mail.requesterEmail = requesterEmail

        },

        send_mail_clear(){
            this.send_mail = {emailBody: '', isLoading: false}
        },

        queryParamsLoader(){
            this.contact_with_product_reviewer_request = this.getParameterByName('contact_with_product_reviewer_request')
            this.contact_with_product_reviewer_requesterId = this.getParameterByName('contact_with_product_reviewer_requesterId')
            this.reviewId = this.getParameterByName('reviewId')

            if(this.contact_with_product_reviewer_request && this.contact_with_product_reviewer_requesterId && this.reviewId){
                this.requests_data = this.requests_data.filter((item)=> {
                    return item.contact_with_product_reviewer_requesterId==this.requesterId &&  item.reviewId==this.reviewId 
                })

                this.requests_data = this.arrayOfObjectSortDesc(this.requests_data, 'contact_w_reviewer_req_id')
            }
        },
        customFilter(value, search, item){

            if(value && search && typeof value === 'string'){

                {{-- console.log('called')
                console.log('value = ', value)
                console.log('search')
                console.log(search)
                console.log('item')
                console.log(item) 
                console.log(item)--}}



                totalSearchItemString = this.string_concat(' ',[item.comment, item.contact_w_reviewer_req_id, this.datetimeprocessing(item.created_at), item.genericBrand, item.genericBrandId, item.rating, item.requesterEmail,  item.requesterName, item.reviewerEmail, item.reviewerName, item.reviewerPhone, item.rating, item.rating, this.processRegisterUnregister(item), this.processMailSentNotSent(item)])

                {{-- console.log('totalSearchItemString = ')
                console.log(totalSearchItemString) --}}
    
                return totalSearchItemString.toString().toLowerCase().indexOf(search) !== -1
            }
        },
        processRegisterUnregister(obj){
            return (obj.requesterId) ? 'Only Registered': 'Only Unregistered, Not Registered';
        },

        processMailSentNotSent(obj){
            return ((obj.isMailSent||0)==1) ? 'Mail already sent': '';
        },


    },
    computed: {
      
    },
    watch: {
      
    },
    
  })

</script>


@endsection