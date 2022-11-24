<style type="text/css">
	.fa .fa-long-arrow-down{
        color: rgb(0, 255, 10) !important;
    }
</style>

@section('slider_content')
<div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container main_slider_responsive_container" data-alias="Loyal-slider-2" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
<!-- START REVOLUTION SLIDER 5.4.6.4 fullwidth mode -->
	<div id="rev_slider_4_1" class="rev_slider fullwidthabanner main_slider_responsive" style="display:none;" data-version="5.4.6.4">

		<ul id="main_slider_responsive_ul">	

			@foreach ($mainsliders_data as $mainslider)
				<li data-index="rs-{{ $mainslider->mainsliderId }}" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="{{ asset($mainslider->photoPath) }}"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
				<!-- MAIN IMAGE -->
					<img src="{{ asset('/image/getImage?url='.$mainslider->photoPath) }}"  alt="image" title="bg-1"   data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="off" class="rev-slidebg main_slider_responsive_img" data-no-retina style="width: 100%; height: auto;">
					<!-- LAYERS -->

					

					<!-- LAYER NR. 2 -->
					<div class="tp-caption tp-layer-selectable  tp-resizeme" 
						id="slide-1-layer-4" 
						data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
						data-y="['top','top','top','top']" data-voffset="['237','242','199','200']" 
									data-fontsize="['50','40','30','20']"
						data-lineheight="['50','50','30','30']"
						data-width="none"
						data-height="none"
						data-whitespace="nowrap"
			
						data-type="text" 
						data-responsive_offset="on" 

						data-frames='[{"delay":10,"speed":1730,"frame":"0","from":"z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
						data-textAlign="['inherit','inherit','inherit','inherit']"
						data-paddingtop="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"

						style="z-index: 6; white-space: nowrap; font-size: 50px; line-height: 50px; font-weight: 700; color: #ffffff; letter-spacing: 3px;font-family:Karla;text-transform:uppercase;">


					
						@if (app()->getLocale()=='en')    {!! $mainslider->text1 !!} 
						@elseif (app()->getLocale()=='ru')    {!! $mainslider->text1RU !!} 
						@elseif (app()->getLocale()=='cn')    {!! $mainslider->text1CN !!} 
						@endif


					</div>

					<!-- LAYER NR. 3 -->
					<div class="tp-caption tp-layer-selectable  tp-resizeme slider-text-2" 
						id="slide-1-layer-5" 
						data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
						data-y="['top','top','top','top']" data-voffset="['304','302','243','246']" 
									data-fontsize="['20','18','14','12']"
						data-width="['836','751','400','377']"
						data-height="['25','26','none','none']"
						data-whitespace="['nowrap','nowrap','nowrap','normal']"
			
						data-type="text" 
						data-responsive_offset="on" 

						data-frames='[{"delay":1060,"split":"chars","splitdelay":0.05,"speed":1280,"split_direction":"forward","frame":"0","from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
						data-textAlign="['center','inherit','inherit','center']"
						data-paddingtop="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"

						style="z-index: 7; min-width: 836px; max-width: 836px; max-width: 25px; max-width: 25px; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;font-family:karla;text-align:center !important;">


							@if (app()->getLocale()=='en')    {!! $mainslider->text2 !!} 
							@elseif (app()->getLocale()=='ru')    {!! $mainslider->text2RU !!} 
							@elseif (app()->getLocale()=='cn')    {!! $mainslider->text2CN !!} 
							@endif 
					</div>

					

					<!-- LAYER NR. 5 -->
					{{-- <div class="tp-caption tp-layer-selectable  tp-resizeme" 
						id="slide-1-layer-7" 
						data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
						data-y="['top','top','top','top']" data-voffset="['533','533','430','434']" 
									data-fontsize="['15','15','13','13']"
						data-width="none"
						data-height="none"
						data-whitespace="nowrap"
			
						data-type="text" 
						data-responsive_offset="on" 

						data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
						data-textAlign="['inherit','inherit','inherit','inherit']"
						data-paddingtop="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"

						style="z-index: 9; white-space: nowrap; font-size: 15px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;font-family:karla;text-transform:uppercase; margin-top: -100px;">Scroll down </div> --}}

					<!-- LAYER NR. 6 -->
					{{-- <div class="tp-caption tp-layer-selectable  tp-resizeme" 
						id="slide-1-layer-9" 
						data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
						data-y="['top','top','top','top']" data-voffset="['567','567','460','464']" 
									data-fontsize="['30','30','25','25']"
						data-width="none"
						data-height="none"
						data-whitespace="nowrap"
			
						data-type="text" 
						data-responsive_offset="on" 

						data-frames='[{"delay":10,"speed":1810,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power3.easeIn"}]'
						data-textAlign="['inherit','inherit','inherit','inherit']"
						data-paddingtop="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"

						style="z-index: 10; white-space: nowrap; font-size: 30px; line-height: 22px; font-weight: 400; color: rgb(9, 255, 41); letter-spacing: 0px;font-family:Open Sans;" ><i class="fa fa-long-arrow-down"></i> </div> --}}
				</li>
			@endforeach

		</ul>



<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>	

</div>
</div>




<style>
	@media (max-width: 575px) { 
		.main_slider_responsive_container, .main_slider_responsive, .main_slider_responsive_ul,.tp-fullwidth-forcer, .main_slider_responsive_img {
			width: 100%;
			height: 250px !important;
			display: none !important;
			visibility: hidden !important;
		}
		.main_slider_responsive_scroll, .fa-long-arrow-down{
			margin-top: -110px;
		}
	}

	/* // Small devices (landscape phones, 576px and up) */
	@media (min-width: 576px) { 
		.main_slider_responsive_container, .main_slider_responsive, .main_slider_responsive_ul,.tp-fullwidth-forcer, .main_slider_responsive_img {
			width: 100%;
			height: 300px !important;
			
		}

		/* .main_slider_responsive_scroll, .fa-long-arrow-down{
			margin-top: -120px;
		} */
	 }

	/* // Medium devices (tablets, 768px and up) */
	@media (min-width: 768px) { 
		.main_slider_responsive_container, .main_slider_responsive, .main_slider_responsive_ul,.tp-fullwidth-forcer, .main_slider_responsive_img {
			width: 100%;
			height: 350px !important;
		}

		/* .main_slider_responsive_scroll, .fa-long-arrow-down{
			margin-top: -120px;
		} */
	 }

	/* // Large devices (desktops, 992px and up) */
	@media (min-width: 992px) { 
		.main_slider_responsive_container, .main_slider_responsive, .main_slider_responsive_ul,.tp-fullwidth-forcer, .main_slider_responsive_img {
			width: 100%;
			height: 400px !important;
		}

		/* .main_slider_responsive_scroll, .fa-long-arrow-down{
			margin-top: -120px;
		} */
	 }

	/* // Extra large devices (large desktops, 1200px and up) */
	@media (min-width: 1200px) { 
		.main_slider_responsive_container, .main_slider_responsive, .main_slider_responsive_ul,.tp-fullwidth-forcer, .main_slider_responsive_img {
			width: 100%;
			height: 450px !important;
		}
		/* .main_slider_responsive_scroll, .fa-long-arrow-down{
			margin-top: -120px;
		} */
	 }
</style>


<style>
	.slider-text-2{
		white-space: normal !important;
		max-height: 50px !important;
	}
</style>

@endsection