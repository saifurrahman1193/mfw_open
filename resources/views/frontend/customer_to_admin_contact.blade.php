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
@else
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.min.js"></script>
@endif

<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script src="{{ asset('js/mixins/common.js') }}"></script>
<script src="{{ asset('js/components/readmoreless.js') }}"></script>
<script src="{{ asset('js/mixins/algorithms.js') }}"></script>
<script src="{{ asset('js/modals/alertmixins.js') }}"></script>
<script src="{{ asset('js/modals/alert.js') }}"></script>

{{--  pic  --}}
<script src="{{ asset('js/mixins/picture.js') }}"></script>


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
                        Customer to admin contact messages
                        <v-spacer></v-spacer>
                    </v-card-title>

                    <v-card-text>

                        <v-row class="mb-2">

                            <v-chip color="primary"  outlined class="ml-5" v-if="customer_to_admin_contact==1" @click="clearQueryParams(current_url)">Show All</v-chip>

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
                            :items="customer_to_admin_contacts"
                            :search="search"
                            :footer-props="{'items-per-page-options':[30, 50, 100, 500, -1]}"
                            :custom-filter="customFilter"
                            >   
                            
                              <template v-slot:item="{item, index}">
                                <tr>
                                    <td>
                                        <span v-text="item.customertoadmincontactId"></span>
                                    </td>
                                    <td>
                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-icon  v-on="on" color="primary"  v-on="on"  @click="send_mail_dialog=true; send_mail_dialog_data_set(item.customertoadmincontactId, item.customerId, item.manualName, item.manualEmail)">forward_to_inbox</v-icon>
                                            </template>
                                            <span v-text="`Send Mail`"></span>
                                        </v-tooltip>

                                        <v-tooltip top>
                                            <template v-slot:activator="{ on }">
                                                <v-icon color="pink" v-on="on" @click="customer_to_admin_contacts_delete(item)" >delete</v-icon>
                                            </template>
                                            <span>Delete Record?</span>
                                        </v-tooltip>

                                        <v-tooltip top v-if="!(item.isBlocked==1)">
                                            <template v-slot:activator="{ on }">
                                                <v-icon color="red" v-on="on" @click="block_a_person_by_mail(item.manualName, item.manualEmail)" >block</v-icon>
                                            </template>
                                            <span>Block this person?</span>
                                        </v-tooltip>

                                        <v-chip v-if="(item.isMailSent||0)==1" color="success" outlined small>Mail already sent</v-chip>
                                        <v-chip v-if="item.isBlocked==1" :color="item.isBlocked==1 ? 'pink': ''" outlined small>Blocked</v-chip>

                                    </td>
                                    <td>
                                        <lists_c
                                            :lists="[
                                                {key: '<b>Sender</b>', value: '' },
                                                {key: processCustomerToAdminRequesterLink(item), value: '' },
                                                {key: item.manualEmail, value: '' },
                                                {key: datetimeprocessing(item.created_at), value: '' },
                                                {key: customerDataReportGenerator(item.customerId), value: '' },
                                            ]"
                                        ></lists_c>
                                    </td>

                                    <td>
                                        <v-chip :color="item.customerId ? 'success': 'pink'" small  dark v-text="item.customerId ? 'Registered': 'Unregistered'"></v-chip>
                                    </td>
                                    
                                    <td>
                                        <readmoreless_c :text="item.message"></readmoreless_c>
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



<script>

  var _this = this
  
  var app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
    mixins: [commonMixin, algorithmMixin,  alertMixin, pictureMixin, zoomMixin],
    components:{},

    mounted() {
        this.customer_to_admin_contacts_data()
    },
    
    data: {
        search: '',
        headers: [
            {
                text: 'Id',
                value: 'customertoadmincontactId'
            },
            { text: 'Actions', value: 'action', sortable: false },

            {
                text: 'Sender',
                value: 'sender',
            },
            {
                text: 'Registered?',
                value: 'registered',
            },

            {
                text: 'Message',
                value: 'message',
            },
            
        ],
        customer_to_admin_contacts: [],


        {{--  send_mail_dialog  --}}
        send_mail_dialog: false,
        send_mail: {emailBody: '', isLoading: false},
        mailData:[],


        {{--  query params  --}}
        customer_to_admin_contact: '',
        customer_to_admin_contactRequesterId: '',
        
    },
    methods: {

        block_a_person_by_mail(name='', email=''){
            var _this=this
            if(email.length>3){
                if( confirm("Do you really want to proceed?")){
                    axios.post('/customers/block_a_person_by_mail', {'postData' : {'name': name,'email': email,'reason': ' Customer to admin contact messages', 'blockTypeId': 1}, 'X-CSRF-Token': '{{ csrf_token() }}'})
                    .then(function (response) {
                        _this.customer_to_admin_contacts_data()
                        _this.s_alert=true
                    })
                    .catch(function (error) {
                        _this.e_alert=true
                    })
                }
                
            }
        },

        customer_to_admin_contacts_delete(obj={}){
            var _this=this
            if(confirm("Do you really want to proceed?")){
                axios.post('/customers/customer_to_admin_contacts_delete', {'postData': obj,'X-CSRF-Token': '{{ csrf_token() }}'})
                .then(function (response) {
                    _this.customer_to_admin_contacts_data()
                    _this.s_alert=true
                })
                .catch(function (error) {
                    _this.e_alert=true
                })
            }
        },
      
        customer_to_admin_contacts_data(){
            var _this=this
            axios.post('/customers/customer_to_admin_contacts_data', {'X-CSRF-Token': '{{ csrf_token() }}'})
            .then(function (response) {
                _this.customer_to_admin_contacts = response.data.data
                _this.mailData = response.data.mailData
                _this.customer_to_admin_contacts = _this.arrayOfObjectSortDesc(_this.customer_to_admin_contacts, 'customertoadmincontactId', true)
                _this.queryParamsLoader()
            })
            .catch(function (error) {
                _this.customer_to_admin_contacts = []
            })
        },

        processCustomerToAdminRequesterLink(obj = {}){
            if(obj.customerId){
                return `<a target='_blank' href='${'/customers/customerProfileUpdate/'+obj.customerId}'>${obj.manualName}</a>`;
            }
            else{
                return `${obj.manualName}`;
            } 
        },

        queryParamsLoader(){
            this.customer_to_admin_contact = this.getParameterByName('customer_to_admin_contact')
            this.customer_to_admin_contactRequesterId = this.getParameterByName('customer_to_admin_contactRequesterId')

            if(this.customer_to_admin_contact && this.customer_to_admin_contactRequesterId ){
                this.customer_to_admin_contacts = this.customer_to_admin_contacts.filter((item)=> {
                    return this.customer_to_admin_contactRequesterId==item.customerId  
                })
                this.customer_to_admin_contacts = this.arrayOfObjectSortDesc(this.customer_to_admin_contacts, 'customertoadmincontactId')
            }
        },

        processBody(){
            this.send_mail.emailBody = this.mailData.filter((mail) => {
                return mail.emailBodyId==this.send_mail.emailBodyId
            }).map((item)=>{
                return item.emailBody
            })[0]
        },

        close_send_mail_dialog(){
            this.send_mail = {emailBody: '', isLoading: false}

            this.send_mail_dialog = false
        },

        send_mail_dialog_confirm(){
            var _this=this
            if(confirm("Do you really want to proceed?")){
                this.send_mail.isLoading=true
                axios.post('/customers/customer_to_admin_contacts_mail_send', {'postData': this.send_mail, 'X-CSRF-Token': '{{ csrf_token() }}'})
                .then(function (response) {
                    _this.customer_to_admin_contacts_data()
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

        send_mail_clear(){
            this.send_mail = {emailBody: '', isLoading: false}
        },

        send_mail_dialog_data_set(customertoadmincontactId='', customerId='', manualName='', manualEmail='')
        {
            this.send_mail.customertoadmincontactId = customertoadmincontactId
            this.send_mail.customerId = customerId
            this.send_mail.manualName = manualName
            this.send_mail.manualEmail = manualEmail
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



                totalSearchItemString = this.string_concat(' ',[item.manualEmail, item.manualName, item.message, this.datetimeprocessing(item.created_at), item.customertoadmincontactId, this.processRegisterUnregister(item), this.processMailSentNotSent(item)])

                {{-- console.log('totalSearchItemString = ')
                console.log(totalSearchItemString) --}}
    
                return totalSearchItemString.toString().toLowerCase().indexOf(search) !== -1
            }
        },

        processRegisterUnregister(obj){
            return (obj.customerId) ? 'Only Registered': 'Only Unregistered, Not Registered';
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