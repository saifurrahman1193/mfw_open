
@section('testimonials_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
<div class="testimonial-sec container-fluid " style="max-height: 420px !important;">
<div class="container" style="max-height: 420px !important;"> 


      
  <div class="col-md-12 heading white">
      <h1>
        @if (app()->getLocale()=='en')    Our
        @elseif (app()->getLocale()=='ru')    наш
        @elseif (app()->getLocale()=='cn')   我们的 
        @endif
      </h1>
        <h2>
          
            @if (app()->getLocale()=='en')    Testimonials
            @elseif (app()->getLocale()=='ru')    Отзывы
            @elseif (app()->getLocale()=='cn')   褒奖 
            @endif
        </h2>
    </div>
    <div class="clearfix"></div>

    <div class="testimonial-carousel " style="max-height: 420px !important;">
            <div class="owl-carousel special-offer" id="testimonial-slider"  style="max-height: 420px !important;">


              @foreach ( $testimonial_data as $testimonial)
                <div class="item " style="max-height: 420px !important;">
                      {{-- <img class="text-center lozad" style="max-width: 40px; margin: 0 auto;" data-src="{{ asset('frontend/img/index-2/quote.png')}}"  alt="image" /><br> --}}
                  <div class="carousel-caption text-center" style="max-height: 420px !important; ">
                        <p class="desktop-mt-0">
                          @if (app()->getLocale()=='en')   
                            {!! strlen($testimonial->testimonial)>200?substr($testimonial->testimonial, 0, 200): $testimonial->testimonial !!}
                            @if (strlen($testimonial->testimonial)>200)
                              <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                              data-title='' 
                              data-body='{{ $testimonial->testimonial }}' 
                               class="hugemodal-a" 
                              >
                                {{ __('header.readmore').'...' }}  
                              </a>
                            @endif
                          @elseif (app()->getLocale()=='ru')   
                           {!! strlen($testimonial->testimonialRU)>200?substr($testimonial->testimonialRU, 0, 200): $testimonial->testimonialRU !!}
                           @if (strlen($testimonial->testimonialRU)>200)
                              <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                              data-title='' 
                              data-body='{{ $testimonial->testimonialRU }}' 
                               class="hugemodal-a" 
                              >
                                {{ __('header.readmore').'...' }}  
                              </a>
                            @endif
                          @elseif (app()->getLocale()=='cn')   
                           {!! strlen($testimonial->testimonialCN)>200?substr($testimonial->testimonialCN, 0, 200): $testimonial->testimonialCN !!}
                           @if (strlen($testimonial->testimonialCN)>200)
                              <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                              data-title='' 
                              data-body='{{ $testimonial->testimonialCN }}' 
                               class="hugemodal-a" 
                              >
                                {{ __('header.readmore').'...' }}  
                              </a>
                            @endif
                          @endif


                        </p><br>

                        @if (strlen($testimonial->photoPath)>0)
                          <img class="lozad" data-src="{{ asset('/image/getImage?url='.($testimonial->photoPath==null ? 'images/avatar.png' : $testimonial->photoPath) ) }}"  style="max-width: 90px; max-height: 90px; margin: 0 auto;"  alt="image" />
                        @elseif(strlen($testimonial->manual_picpath)>0)
                          <img class="lozad" data-src="{{ asset('/image/getImage?url='.($testimonial->manual_picpath==null ? 'images/avatar.png' : $testimonial->manual_picpath) ) }}"  style="max-width: 90px; max-height: 90px; margin: 0 auto;"  alt="image" />
                        @endif
                        
                        <br>
                        <h2 style="padding: 0px; margin: 0px;">{{ strlen( $testimonial->name !=  null ) ? '- '.$testimonial->name : '' }}</h2>
                  </div>

                  {{-- <div class="col-md-12 text-center heading"><a href="#" class="def-btn">Request For Contact</a></div> --}}
                  <div class="col-md-12 text-center heading"  style="padding: 0px; margin: 0px;">
                    <a href="#"   data-toggle="modal" data-target="#clientContact-Modal" data-clientcontact="@if (app()->getLocale()=='en')   {{ $testimonial->clientContact }}
                            @elseif (app()->getLocale()=='ru')    {{ $testimonial->clientContactRU }}   @elseif (app()->getLocale()=='cn')   {{ $testimonial->clientContactCN }} @endif" data-testimonialid="{{ $testimonial->testimonialId }}" data-visibility="{{ $testimonial->visibility }}" class="def-btn " style="padding: 2px 10px !important; ">
                      <i class="flaticon-phone-call "></i>
                    </a>
                    <a href="#"   data-toggle="modal" data-target="#clientContact-Modal" data-clientcontact="@if (app()->getLocale()=='en')   {{ $testimonial->clientContact }}
                            @elseif (app()->getLocale()=='ru')    {{ $testimonial->clientContactRU }}    @elseif (app()->getLocale()=='cn')   {{ $testimonial->clientContactCN }}   @endif" data-testimonialid="{{ $testimonial->testimonialId }}" data-visibility="{{ $testimonial->visibility }}" class="def-btn " style="padding: 2px 10px !important; ">
                      <i class="flaticon-e-mail-envelope "></i>
                    </a>
                  </div>

                </div>

              @endforeach
              
              
            </div>
        </div>
        
</div>    
</div>

<style scoped>
    @media (max-width: 768px) {
      .testimonial-sec{
        max-height: 350px !important;
      }

      .testimonial-sec .item p{
        max-width: 100% !important;
        margin: 15px 0 15px !important;
      }

      .testimonial-sec .item{
        padding-bottom: 5px !important;
      }

      .carousel-caption{
        padding-top: 5px !important;
      }

      .testimonial-sec .item h2{
        font-size: 18px !important;
      }

    }

    @media (min-width: 769px) {
      .desktop-mt-0{
        margin-top:  0px !important;
      }

    }

</style>



<style scoped>
  .owl-controls{
      color: transparent;
  }

  #testimonial-carousel .owl-stage-outer, #testimonial-carousel .owl-stage{
    max-height: 270px !important;
  }
</style>

<style>
  .hugemodal-a{
    color: #caa472;
  }

  .hugemodal-a:hover{
    font-weight: bold;
    text-decoration: underline;
  }
</style>



<!--Modal Popup starts-->
<div class="modal fade" id="clientContact-Modal" tabindex="-1" role="dialog" aria-labelledby="clientContact-Modal" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content" style="min-height: 250px;">
      <div class="modal-header">
        <h3 class="modal-title col-md-11"  id="clientContact-Modal-title"></h3>
        <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
      </div>
      <div class="modal-body" >
        <div class="row">
            <p id="clientContact-Modal-body" style="word-wrap: break-word; max-width: 100%; padding: 20px; "></p>

            <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('testimonial_contact_request') }}"  onsubmit="return confirm('{!!__('productdetails.confirmalert')!!}');">
                  {{ csrf_field() }}

                  <input type="hidden"  name="testimonialId" id="testimonialId" value="">
                  <input type="hidden"  name="requesterId" id="requesterId" value="">



                  <div class="col-md-12" id="requesterName-container">
                    <div class="form-group row required">
                      <label class="col-sm-4 col-form-label control-label">{{ __('checkout.name') }}</label>
                      <div class="col-sm-8">
                        <input type="text" name="requesterName" id="requesterName" class="form-control" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12" id="requesterEmail-container">
                    <div class="form-group row required">
                      <label class="col-sm-4 col-form-label control-label">{{ __('checkout.email') }}</label>
                      <div class="col-sm-8">
                        <input type="email" name="requesterEmail" id="requesterEmail" class="form-control" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12" id="captcha-container">
                    <div class="form-group   required">
                        <label  class="col-md-4 col-form-label  control-label col-xs-12 " style="text-align: left;">{{ __('productdetails.captcha') }}</label>
                        <div class="col-md-2 col-xs-5"> <input type="number" id="num1" class="form-control" readonly> </div>
                        <label  class="col-md-1 col-form-label   col-xs-1" >+</label>
                        <div class="col-md-2  col-xs-5"> <input type="number" id="num2" class="form-control" readonly> </div>
                        <label  class="col-md-1 col-form-label   col-xs-1" >=</label>
                        <div class="col-md-2"> <input type="number" id="result" class="form-control" title="Please enter summation of 2 numbers" required> </div>
                    </div>
                  </div>

                  <div class="col-md-12" id="submit">
                    <div class="form-group row ">
                      <label class="col-sm-4 col-form-label "></label>
                      <div class="col-md-8  mt-2">
                          <button type="submit" class="btn btn-success float-right" id="submit-button">
                              Submit
                          </button>
                      </div>
                    </div>
                  </div>

            </form>

        </div>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        // console.log('working')
        // console.log("$('#banner').owlCarousel.length = "+ $('#banner').owlCarousel.length)
      
        var owl = $('#testimonial-slider');
        owl.owlCarousel({
            items:1,
            loop: true,
            margin:10,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        });
    });

    function stopCarouselAutoPlay(){
      var owl = $('#testimonial-slider');
      $(function(e) {
          owl.trigger('stop.owl.autoplay');
      })
    }

    function playCarouselAutoPlay(){
      var owl = $('#testimonial-slider');
      $(function(e) {
          owl.trigger('play.owl.autoplay');
      })
    }

    $(function(){
        $('#clientContact-Modal').on('show.bs.modal', function (event) {

            stopCarouselAutoPlay()

            var button = $(event.relatedTarget) ;

            var clientContact = button.data('clientcontact') ;
            var testimonialId = button.data('testimonialid') ;
            var requesterId = {{ Auth::check() ? Auth::user()->id : -1 }} ;
            var visibility = button.data('visibility') ;


            // var body = button.data('body') ;

            var modal = $(this);
            modal.find('.modal-body #requesterId').val('');
            modal.find('.modal-body #testimonialId').val('');

            // modal.find('.modal-header #clientContact-Modal-title').text(title);
            document.getElementById('clientContact-Modal-body').innerHTML = clientContact
            modal.find('.modal-body #testimonialId').val(testimonialId);
            if(requesterId > 0){
               modal.find('.modal-body #requesterId').val(requesterId);
            }
            if(visibility==1){
              modal.find('.modal-body #submit').hide();
              modal.find('.modal-body #requesterName-container').hide();
              modal.find('.modal-body #requesterEmail-container').hide();
              modal.find('.modal-body #captcha-container').hide();
            }
            else{
              modal.find('.modal-body #submit').show();
              modal.find('.modal-body #requesterName-container').show();
              modal.find('.modal-body #requesterEmail-container').show();
              modal.find('.modal-body #captcha-container').show();
            }
        });

        $('#clientContact-Modal').on('hidden.bs.modal', function (e) {
          stopCarouselAutoPlay()
          setTimeout(function(){ 
            playCarouselAutoPlay()
          }, 3000);
        });

        $(function(){
            $('#hugeDataModal').on('show.bs.modal', function (event) {
              playCarouselAutoPlay()
              stopCarouselAutoPlay()
            });
        });

        $('#hugeDataModal').on('hidden.bs.modal', function (e) {
          stopCarouselAutoPlay()
          setTimeout(function(){ 
            playCarouselAutoPlay()
          }, 3000);
        });
    });
<!--Modal Popup ends-->



{{-- math captcha --}}

  $(document).ready(function() {

      $('#submit-button').attr('disabled', true);


      var x = Math.floor((Math.random() * 99) + 1);
      var y = Math.floor((Math.random() * 9) + 1);

      var z = x+y;

      $('#num1').val(x)
      $('#num2').val(y)


      $('#result').on('click keyup keydown change mouseover mouseleave',  function(event) {
          var result =  $('#result').val();

          // console.log(result)
          // console.log(z)
          if (result==z) {
             $('#submit-button').attr('disabled', false); 
          }else {
             $('#submit-button').attr('disabled', true); 
          }
      });
  });



  $(window).on('load',function(){
      @if (session('testimonial_contact_request_limit_overload'))
          $('#testimonial_contact_requestModal').modal('show');
      @endif
  });
</script>


<div class="container" style="z-index: 10000000000000000000000">
  <div class="row">
      <div class="modal fade" id="testimonial_contact_requestModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title col-md-11"  id="testimonial_contact-Modal-title"></h3>
                    <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
                  </div>
                  <div class="modal-body">
                    <div class="thank-you-pop">
                      <p> {{ __('modals.testimonial_limit_crossed') }} </p>
                      </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
</div>


@endsection