<!DOCTYPE html>

@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'SHOW PRODUCTS BY GENERIC')
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
                <v-card elevation="1" >
                    <v-card-title primary-title >
                        <v-spacer></v-spacer>                                           
                        SHOW PRODUCTS BY GENERIC
                        <v-spacer></v-spacer>
                    </v-card-title>
                    <v-form @submit.prevent="crudConfirm()">
                        <v-card-text>

                            <v-row >
                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-autocomplete
                                        label="Generic*"
                                        :items="generics"
                                        item-text="genericName"
                                        item-value="genericId"
                                        dense
                                        v-model="generic.genericId"
                                        clearable
                                        @change="genericIdChangeHandler()"
                                        :rules="genericIdRules"
                                        :error-messages="genericError.genericId"
                                    >
                                    </v-autocomplete>
                                </v-col>

                            </v-row>


                            <v-card class="mt-2">
                            <v-card-title primary-title >
                            <v-spacer></v-spacer>
                            Generic Brands
                            <v-spacer></v-spacer>
                            </v-card-title>
                                <v-card-text>

                                    <v-row class="mb-2">
                                        <v-spacer></v-spacer>
                                        <v-text-field
                                            v-model="search_genericbrands"
                                            append-icon="mdi-magnify"
                                            label="Search"
                                            single-line
                                            hide-details
                                        ></v-text-field>
                                    </v-row>

                                    <v-data-table
                                    :headers="headers_genericbrands"
                                    :items="genericbrands"
                                    :search="search_genericbrands"
                                    >


                                    <template v-slot:[`item.product`]="{ item }">

                                        <v-img
                                            :src="'/image/getImage?url='+item.picPath+'&sizeX=75&sizeY=75' || '/uploads/no_image.png'"
                                            aspect-ratio="1"
                                            class="grey lighten-2 image-hover-cursor-change"
                                            style="background:rgba(0,0,0,0) !important; border-color:orange !important;"
                                            max-width="75"
                                            max-height="75"

                                            @click="imageZoom(item.picPath)"
                                            >
                                        </v-img>

                                        
                                        <a :href="'/en/productDetailsPageCaller/'+item.genericBrandId"
                                        target="_blank">
                                            Go to product details page
                                        </a>

                                    </template>

                                    </v-data-table>
                                </v-card-text>

                            </v-card>

                            <v-row >
                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea 
                                    name="metaTitle" 
                                    label="Meta Title*" 
                                    v-model="generic.metaTitle"
                                    :rules="metaTitleRules"
                                    :error-messages="genericError.metaTitle"
                                    
                                    ></v-textarea>                                   
                                </v-col>

                                

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="metaTitleCN" label="Meta Title CN*" v-model="generic.metaTitleCN"
                                    :rules="metaTitleCNRules"
                                    :error-messages="genericError.metaTitleCN"
                                    ></v-textarea>
                                </v-col>

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="metaTitleRU" label="Meta Title RU*" v-model="generic.metaTitleRU"
                                    :rules="metaTitleRURules"
                                    :error-messages="genericError.metaTitleRU"
                                    ></v-textarea>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col md="6" sm="12" xs="12" cols="auto">
                                <v-textarea name="metaDescCN" label="Meta Desc" v-model="generic.metaDesc"
                                ></v-textarea>

                                </v-col>

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="metaDescCN" label="Meta Desc CN" v-model="generic.metaDescCN"
                                    ></v-textarea>
                                </v-col>

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="metaDescRU" label="Meta Desc RU" v-model="generic.metaDescRU"
                                    ></v-textarea>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="metaKeywords" label="Meta keywords" v-model="generic.metaKeywords"
                                    ></v-textarea>
                                </v-col>

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="metaKeywordsCN" label="Meta keywords CN" v-model="generic.metaKeywordsCN"
                                    ></v-textarea>
                                </v-col>

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="metaKeywordsRU" label="Meta keywords RU" v-model="generic.metaKeywordsRU"
                                    ></v-textarea>
                                </v-col>
                            </v-row>


                            <v-row>
                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="description" label="Description" v-model="generic.description"
                                    ></v-textarea>
                                </v-col>

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="descriptionCN" label="Description CN" v-model="generic.descriptionCN"
                                    ></v-textarea>
                                </v-col>

                                <v-col md="6" sm="12" xs="12" cols="auto">
                                    <v-textarea name="descriptionRU" label="Description RU" v-model="generic.descriptionRU"
                                    ></v-textarea>
                                </v-col>
                            </v-row>


                        </v-card-text>
                        <v-card-actions >
                            <v-spacer></v-spacer>
                            <v-btn color="error" text  @click="clearForm()">Clear</v-btn>
                            <v-btn color="success"  type="submit" v-text=" generic.genericforallproductId ? 'Update' : 'Add'" 
                            :disabled="!(generic.genericforallproductId || (generic.genericId && generic.metaTitle && generic.metaTitleCN && generic.metaTitleRU ))"></v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-form>
                </v-card>

                <v-card class="mt-2">
                    <v-card-title primary-title >
                        <v-spacer></v-spacer>
                        Generic For All Products Listed
                        <v-spacer></v-spacer>
                    </v-card-title>
                    <v-card-text>
                        <v-row class="mb-2">
                            <v-spacer></v-spacer>
                            <v-text-field
                                v-model="search_genericforallproducts"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-row>
                        <v-data-table
                        :headers="headers_genericforallproducts"
                        :items="genericforallproducts"
                        :search="search_genericforallproducts"
                        >

                                <template v-slot:[`item.action`]="{ item }">

                                    <v-chip :color="item.isViewable==1 ? 'success' :'red lighten-1'" dark :outlined="item.isViewable!=1"
                                        @click="updateGenericforallproductvisibility(item.genericforallproductId, item.isViewable==1?0:1); "
                                        
                                        >
                                            <v-icon small v-text="item.isViewable==1 ? 'visibility' : 'visibility_off'"></v-icon>
                                             &nbsp;
                                            <span v-text="item.isViewable==1 ? 'Visible' : 'Invisible'"></span>
                                    </v-chip>

                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <v-icon @click="getGenericforallproductwithgenericid(item.genericId); topFunction()" v-on="on">edit</v-icon>
                                        </template>
                                        <span>Edit Record ?</span>
                                    </v-tooltip>

                                    <v-tooltip top >
                                        <template v-slot:activator="{ on }">
                                            <v-icon @click="deleteConfirm(item.genericforallproductId)" v-on="on">delete</v-icon>
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
        this.getAllGenerics()
        this.getGenericforallproducts()
    },
    
    data: {
        generics: [],
        generic: {},
        
        genericforallproducts: [],
        search_genericforallproducts: '',
        headers_genericforallproducts: [
                    { text: 'Actions', value: 'action', sortable: false },
                    {
                        text: 'Id',
                        value: 'genericforallproductId',
                    },
                    {
                        text: 'Generic Id',
                        value: 'genericId',
                    },
                    {
                        text: 'Generic',
                        value: 'genericName',
                    },
                    {
                        text: 'Meta Title',
                        value: 'metaTitle',
                    },
                    {
                        text: 'Meta Title CN',
                        value: 'metaTitleCN',
                    },
                    {
                        text: 'Meta TitleRU',
                        value: 'metaTitleRU',
                    },

                    {
                        text: 'Meta Desc',
                        value: 'metaDesc',
                    },
                    {
                        text: 'Meta Desc CN',
                        value: 'metaDescCN',
                    },
                    {
                        text: 'Meta Desc RU',
                        value: 'metaDescRU',
                    },
                    // {
                    //     text: 'Meta Keywords',
                    //     value: 'metaKeywords',
                    // },
                    // {
                    //     text: 'Meta Keywords CN',
                    //     value: 'metaKeywordsCN',
                    // },
                    // {
                    //     text: 'Meta Keywords RU',
                    //     value: 'metaKeywordsRU',
                    // },
                    {
                        text: 'Description',
                        value: 'description',
                    },
                    {
                        text: 'Description CN',
                        value: 'descriptionCN',
                    },
                    {
                        text: 'Description RU',
                        value: 'descriptionRU',
                    },
                    

        ],

        genericbrands: [],
        search_genericbrands: '',
        

        headers_genericbrands: [
                    {
                        text: 'Generic Brand Id',
                        value: 'genericBrandId',
                    },
                    {
                        text: 'Product',
                        value: 'product',
                    },
                    {
                        text: 'Generic Brand',
                        value: 'genericBrand',
                    },
                    {
                        text: 'Generic',
                        value: 'genericName',
                    },
                    {
                        text: 'Generic Brand Company',
                        value: 'genericCompany',
                    },
                    {
                        text: 'Dosage Form',
                        value: 'dosageForm',
                    },
                    {
                        text: 'Disease Category',
                        value: 'diseaseCategories',
                    },
                ],

        genericError: {
            genericId: '', metaTitle: '', metaTitleCN: '', metaTitleRU: '', 
        },
        genericIdRules: [
            v => !!v || 'Generic Name is required',
        ],
        metaTitleRules: [
            v => !!v || 'Meta title is required',
        ],

        metaTitleCNRules: [
            v => !!v || 'Meta title CN is required',
        ],

        metaTitleRURules: [
            v => !!v || 'Meta title RU is required',
        ],
        metaDataIfNoGenericforallproductId:{
           metaTitle:'' , metaTitleCN: '',  metaTitleRU: '', metaDesc:'' , metaDescCN: '',  metaDescRU: '' 
        },
        
    },
    methods: {
        
        getAllGenerics(){
            var _this=this
            axios.get('/generics/getAllGenerics')
            .then(function (response) {
                _this.generics = response.data.data
            })
            .catch(function (error) {
                _this.generics = []
            })
        },

        getGenericforallproducts(){
            var _this=this
            axios.get('/generics/getGenericforallproducts')
            .then(function (response) {
                _this.genericforallproducts = response.data.data
            })
            .catch(function (error) {
                _this.genericforallproducts = []
            })
        },

        getGenericforallproductwithgenericid(genericId){
            var _this=this
            axios.get('/generics/getGenericforallproductwithgenericid/'+genericId)
            .then(function (response) {
                _this.generic = response.data.data || {'genericId': genericId}
                _this.getGenericBrandswithgenericid(genericId)
            })
            .catch(function (error) {
                _this.generic = {'genericId': genericId}
            })
        },


        getGenericBrandswithgenericid(genericId){
            var _this=this
            axios.get('/generics/getGenericBrandswithgenericid/'+genericId)
            .then(function (response) {
                _this.genericbrands = response.data.data || []
                _this.setMetaDataIfNoGenericforallproductId(_this.genericbrands)
            })
            .catch(function (error) {
                _this.genericbrands = []
            })
        },

        setMetaDataIfNoGenericforallproductId(genericbrands=[]){
            if(this.generic.genericId && (this.generic.genericforallproductId || 0) == 0){
                var genericName = ''
                var genericNameCN = ''
                var genericNameRU = ''

                var globalTradeNameCompany = ''
                var globalTradeNameCompanyCN = ''
                var globalTradeNameCompanyRU = ''

                var genericBrand=''
                var genericBrandCN=''
                var genericBrandRU=''

                var meta_keywords=''
                var meta_keywordsCN=''
                var meta_keywordsRU=''

                genericbrands.forEach( (item, index) => {
                    if (index==0) {
                        genericName = item.genericName
                        genericNameCN = item.genericNameCN
                        genericNameRU = item.genericNameRU

                        globalTradeNameCompany = ((item.globalTradeNameCompany.split('by'))[0]).trim();
                        globalTradeNameCompanyCN = ((item.globalTradeNameCompanyCN.split('by'))[0]).trim();
                        globalTradeNameCompanyRU = ((item.globalTradeNameCompanyRU.split('by'))[0]).trim();

                        genericBrand = genericBrand + item.genericBrand
                        genericBrandCN = genericBrandCN + item.genericBrandCN
                        genericBrandRU = genericBrandRU + item.genericBrandRU

                        meta_keywords = meta_keywords + (item.meta_keywords||'')
                        meta_keywordsCN = meta_keywordsCN + (item.meta_keywordsCN||'')
                        meta_keywordsRU = meta_keywordsRU + (item.meta_keywordsRU||'')
                    }
                    else{
                        genericBrand = genericBrand+ ', '+item.genericBrand
                        genericBrandCN = genericBrandCN+ ', '+item.genericBrandCN
                        genericBrandRU = genericBrandRU+ ', '+item.genericBrandRU


                        meta_keywords = meta_keywords+ ', '+(item.meta_keywords||'')
                        meta_keywordsCN = meta_keywordsCN+ ', '+(item.meta_keywordsCN||'')
                        meta_keywordsRU = meta_keywordsRU+ ', '+(item.meta_keywordsRU||'')
                    }
                });

                this.metaDataIfNoGenericforallproductId.metaTitle = 'Generic '+globalTradeNameCompany+' Generic '+genericName+ ' Price Buy Online'
                this.metaDataIfNoGenericforallproductId.metaTitleCN = '通用的 '+globalTradeNameCompanyCN+' 通用的 '+genericNameCN + ' 价格在线购买'
                this.metaDataIfNoGenericforallproductId.metaTitleRU = 'Родовое '+globalTradeNameCompanyRU+' Родовое '+genericNameRU+' Цена Купить онлайн'

                this.metaDataIfNoGenericforallproductId.metaDesc = 'Buy Generic '+globalTradeNameCompany+' prescription medicine. Generic '+genericName+ ' of '+genericBrand+ ' Buying Cost Online. medicineforworld@gmail.com'
                this.metaDataIfNoGenericforallproductId.metaDescCN = '买通用的 '+globalTradeNameCompanyCN+' 处方药. 通用的 '+genericNameCN + ' 关于 '+genericBrandCN+ ' 网上购买成本. WeChat: medicineforworld_mfw'
                this.metaDataIfNoGenericforallproductId.metaDescRU = 'Купить Родовое '+globalTradeNameCompanyRU+' лекарств по рецепту. Родовое '+genericNameRU+ ' от '+genericBrandRU+ ' стоимость покупки онлайн. medicineforworld@gmail.com'
                
                this.metaDataIfNoGenericforallproductId.description = 'Buy Generic '+globalTradeNameCompany+' prescription medicine. Generic '+genericName+ ' of '+genericBrand+ ' Buying Cost Online.'
                this.metaDataIfNoGenericforallproductId.descriptionCN = '买通用的 '+globalTradeNameCompanyCN+' 处方药. 通用的 '+genericNameCN + ' 关于 '+genericBrandCN+ ' 网上购买成本.'
                this.metaDataIfNoGenericforallproductId.descriptionRU = 'Купить Родовое '+globalTradeNameCompanyRU+' лекарств по рецепту. Родовое '+genericNameRU+ ' от '+genericBrandRU+ ' стоимость покупки онлайн.'

                this.generic.metaTitle = this.metaDataIfNoGenericforallproductId.metaTitle
                this.generic.metaTitleCN = this.metaDataIfNoGenericforallproductId.metaTitleCN
                this.generic.metaTitleRU = this.metaDataIfNoGenericforallproductId.metaTitleRU 

                this.generic.metaDesc = this.metaDataIfNoGenericforallproductId.metaDesc
                this.generic.metaDescCN = this.metaDataIfNoGenericforallproductId.metaDescCN
                this.generic.metaDescRU = this.metaDataIfNoGenericforallproductId.metaDescRU                

                this.generic.description = this.metaDataIfNoGenericforallproductId.description
                this.generic.descriptionCN = this.metaDataIfNoGenericforallproductId.descriptionCN
                this.generic.descriptionRU = this.metaDataIfNoGenericforallproductId.descriptionRU


                this.generic.metaKeywords = this.string_to_normalbehaviour(meta_keywords)
                this.generic.metaKeywordsCN = this.string_to_normalbehaviour(meta_keywordsCN)
                this.generic.metaKeywordsRU = this.string_to_normalbehaviour(meta_keywordsRU)


                // console.log(this.getUniqueData((this.generic.metaKeywords).split(',')))

                this.generic.metaKeywords = (this.getUniqueData((this.generic.metaKeywords).split(','))).join()
                this.generic.metaKeywordsCN = (this.getUniqueData((this.generic.metaKeywordsCN).split(','))).join()
                this.generic.metaKeywordsRU = (this.getUniqueData((this.generic.metaKeywordsRU).split(','))).join()

            }
            else{
                this.metaDataIfNoGenericforallproductId={}
            }
        },

        genericIdChangeHandler()
        {
            if( (this.generic || {}).genericId)
            {
                this.getGenericforallproductwithgenericid(this.generic.genericId) 
            }
            else
            {
                this.clearForm()
            }
        },

        adding(){
            console.log(this.generic)
            var _this=this
            axios.post('/generics/addupdateGenericforallproduct', {'X-CSRF-Token': '{{ csrf_token() }}', 'generic': this.generic} )
            .then(function (response) {
                _this.getGenericforallproducts()
                _this.s_alert = true;
                _this.clearForm()
                _this.addingConfirmed=''
            })
            .catch(function (error) {
                _this.e_alert = true;
            })
        },
        deleting(){
            var _this = this;
            axios.post('/generics/deleteGenericforallproduct/'+this.deletingId, {'X-CSRF-Token': '{{ csrf_token() }}'})
            .then(function (response) {
                _this.s_alert = true;
                _this.getGenericforallproducts()
                _this.clearForm()
            })
            .catch(function (error) {
                _this.e_alert = true;
            })
            this.deletingId=''
        },
        clearForm(){
            this.generic = {}
            this.genericbrands=[]
            this.genericError= { genericId: '', metaTitle: '', metaTitleCN: '', metaTitleRU: '' }
            this.metaDataIfNoGenericforallproductId={}
        },

        updateGenericforallproductvisibility(genericforallproductId, isViewable=1)
        {
            var _this = this;
            axios.post('/generics/updateGenericforallproductvisibility/'+genericforallproductId+'/'+isViewable, {'X-CSRF-Token': '{{ csrf_token() }}' })
            .then(function (response) {
                _this.getGenericforallproducts()
                _this.clearForm()
            })
            .catch(function (error) {
                _this.e_alert = true;
            })
        }

        

    },
    computed: {
      
    },
    watch: {

       
        
    },
    
  })

</script>


@endsection