<!--Modal Popup starts-->
<div class="modal fade" id="customerToAdminContact-Modal" tabindex="-1" role="dialog" aria-labelledby="customerToAdminContact-Modal" aria-hidden="true" style="z-index: 10000000000;">
  <div class="modal-dialog " role="document">
    <div class="modal-content" style="min-height: 250px;">
      <div class="modal-header">
        <h3 class="modal-title col-md-11"  id="customerToAdminContact-Modal-title"></h3>
        <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
      </div>
      <div class="modal-body" >
        <div class="row">
            <p id="customerToAdminContact-Modal-body" style="word-wrap: break-word; max-width: 100%; padding: 20px; "></p>

            <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('customerToAdminContact') }}"  onsubmit="return confirm('{!!__('productdetails.confirmalert')!!}');">
                  {{ csrf_field() }}

                  <input type="hidden"  name="customerId" id="customerId" value="{{ Auth::check() ? Auth::user()->id : '' }}">



                  <div class="col-md-12" >
                    <div class="form-group row required">
                      <label class="col-sm-4 col-form-label control-label">{{ __('checkout.name') }}</label>
                      <div class="col-sm-8">
                        <input type="text" name="manualName" id="manualName" class="form-control" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12" >
                    <div class="form-group row required">
                      <label class="col-sm-4 col-form-label control-label">{{ __('checkout.email') }}</label>
                      <div class="col-sm-8">
                        <input type="email" name="manualEmail" id="manualEmail" class="form-control" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12" >
                    <div class="form-group row required">
                      <label class="col-sm-4 col-form-label control-label">{{ __('checkout.message') }}</label>
                      <div class="col-sm-8">
                            <textarea id="message" name="message"  class="form-control"  rows="4" required></textarea>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group   required">
                        <label  class="col-md-4 col-form-label  control-label col-xs-12 " style="text-align: left;">{{ __('productdetails.captcha') }}</label>
                        <div class="col-md-2 col-xs-5"> <input type="number" id="customertoadmincontact-num1" class="form-control" readonly> </div>
                        <label  class="col-md-1 col-form-label   col-xs-1" >+</label>
                        <div class="col-md-2  col-xs-5"> <input type="number" id="customertoadmincontact-num2" class="form-control" readonly> </div>
                        <label  class="col-md-1 col-form-label   col-xs-1" >=</label>
                        <div class="col-md-2"> <input type="number" id="customertoadmincontact-result" class="form-control" title="Please enter summation of 2 numbers" required> </div>
                    </div>
                  </div>
                  
                  <div id="container"></div>


                  <div class="col-md-12" id="submit">
                    <div class="form-group row ">
                      <label class="col-sm-4 col-form-label "></label>
                      <div class="col-md-8  mt-2">
                          <button type="submit" class="btn btn-success float-right" id="customertoadmincontact-submit-button">
                            {{ __('productdetails.submit') }}
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


<script>
    $(document).ready(function() {

        

        $('#customertoadmincontact-submit-button').attr('disabled', true);
  
  
        var x = Math.floor((Math.random() * 99) + 1);
        var y = Math.floor((Math.random() * 9) + 1);
  
        var z = x+y;
  
        $('#customertoadmincontact-num1').val(x)
        $('#customertoadmincontact-num2').val(y)
  
  
        $('#customertoadmincontact-result').on('click keyup keydown change mouseover mouseleave',  function(event) {
            var result =  $('#customertoadmincontact-result').val();
  
            // console.log(result)
            // console.log(z)
            if (result==z) {
               $('#customertoadmincontact-submit-button').attr('disabled', false); 
                addField()
            }else {
               $('#customertoadmincontact-submit-button').attr('disabled', true); 
               removeField()
            }

        });
    });

    function addField(){

        removeField()

        var container = document.getElementById("container");


        var input = document.createElement("input");
        input.type = "number";
        input.name = "isFormValidToSubmit";
        input.setAttribute("value", 1234)
        input.setAttribute("hidden", true)
        container.appendChild(input);

        var input2 = document.createElement("input");
        input2.type = "string";
        input2.name = "td";
        var todaydate = getTodayDateYmd()
        input2.setAttribute("value", todaydate)
        input2.setAttribute("hidden", true)
        container.appendChild(input2);


        var input3 = document.createElement("input");
        input3.type = "number";
        var dayNumber = getTodayDayNumberOfCurrentYear() 
        input3.name = "tddn_"+dayNumber;
        input3.setAttribute("value", dayNumber)
        input3.setAttribute("hidden", true)
        container.appendChild(input3);

    }


    function getTodayDayNumberOfCurrentYear(){
        var now = new Date();
        var start = new Date(now.getFullYear(), 0, 0);
        var diff = now - start;
        var oneDay = 1000 * 60 * 60 * 24;
        var day = Math.floor(diff / oneDay);

        return day;
    }

    function removeField(){
      var container = document.getElementById("container");
      container.innerHTML=""
    }

    function getTodayDateYmd(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd ;
        return today;
    }


</script>



<script type="text/javascript">
	$(window).on('load',function(){

		@if (session('cutomer_to_admin_contact'))
	        $('#cutomer_to_admin_contact_modal').modal('show');
		@endif
    });
</script>


<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        <div class="modal fade" id="cutomer_to_admin_contact_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title col-md-11">{{ __('modals.cutomer_to_admin_contact_modal_msg') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>