<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericBrand extends Model
{
    protected $table = 'genericbrand';

    protected $primaryKey  = 'genericBrandId';

    protected $fillable = [
            'genericBrand' ,
            'genericBrandCN' ,
            'genericBrandRU' ,
            'genericId' ,

            'genericCompanyId' ,
            'isRxApplicable' ,






            'indicationanddosage',  
            'indicationanddosageCN',  
            'indicationanddosageRU',  
            'sideeffects',  
            'sideeffectsCN',  
            'sideeffectsRU',  
            'prescribinginformation',  
            'prescribinginformationCN',  
            'prescribinginformationRU',  
            'additionalinformation',  
            'additionalinformationCN',  
            'additionalinformationRU',  
            'faq',  
            'faqCN',  
            'faqRU',  
            'suggestion',  
            'suggestionCN',  
            'suggestionRU',  



            'videothumb',  
            'videourl',  
             'youtubevideothumb',  
            'youtubevideourl',  
             'dailymotionvideothumb',  
             'dailymotionvideourl',  
             'vimeovideourl',  
             'vimeovideothumb',  
            
            'isFrontendVisible',  

            'pageTitle',  
            'pageTitleCN',  
            'pageTitleRU',
            
            'meta_keywords',  
            'meta_keywordsCN',  
            'meta_keywordsRU',  

            'meta_description',  
            'meta_descriptionCN',  
            'meta_descriptionRU',  
            
            'alt_tag',
            'alt_tag_CN',
            'alt_tag_RU',


			'updated_at',
			'created_at'
    ];

    protected $casts = [
        'genericBrandId'=> 'integer',
        'genericId'=> 'integer',
        'genericCompanyId'=> 'integer',
        'isRxApplicable'=> 'integer',
    ];

    protected $attributes = [
        'isFrontendVisible' => 1,
    ];

}



