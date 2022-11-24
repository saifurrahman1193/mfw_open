@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'System Environment')

@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>


<div class="content-wrapper" style="min-height: 0px;"  id="app" >

    <div class="card pt-3" v-if="isValidToAccess">
        <h4 class="card-title" style="text-align: center;">System Environment</h4>
        <div class="card-body">

          <div class="row col-md-12">
            <h1 class="tex-center">.Env change Instruction</h1>
            <table class="table">
                <thead>
                  <th>Topic</th>
                  <th>Description</th>
                </thead>
              <tbody>

                <tr>
                  <td><b>Knowledge</b></td>
                  <td>Please do not change anything if do not know anything about it</td>
                </tr>

                <tr>
                  <td><b>Comment</b></td>
                  <td>
                    <b>example:</b> <br><br>
                    <code># this is a single line comment</code> 
                    <br><br>
                  </td>
                </tr>

                <tr>
                  <td><b>Space</b></td>
                  <td>Please avoid any space <br><br> 
                    Like - <code>Hello World</code>, here write like- <code>'Hello World'</code>
                  </td>
                </tr>

                <tr>
                  <td><b>Server .env file access</b></td>
                  <td><code>sudo chown -R www-data .env</code></td>
                </tr>

                <tr>
                  <td><b>APP_DEBUG</b></td>
                  <td>if want to show debug mode then <br><br>
                    <code>APP_DEBUG=true</code><br><br>
                    else  <br><br>
                    <code>APP_DEBUG=false</code> <br><br>
                    After that remove cache in <code>browser</code> and delete files in <code>bootstrap/cache/</code> 

                  </td>
                </tr>

                <tr>
                  <td><b>DB_DATABASE</b></td>
                  <td>Database name of your project</td>
                </tr>

                <tr>
                  <td><b>DB_USERNAME</b></td>
                  <td> <code>user name</code> of your Database</td>
                </tr>
                
                <tr>
                  <td><b>DB_PASSWORD</b></td>
                  <td> <code>password</code> of your Database</td>
                </tr>

                <tr>
                  <td><b>Mail Setups</b></td>
                  <td></td>
                </tr>

                <tr>
                  <td><b>MAIL_DRIVER</b></td>
                  <td><code>smtp</code></td>
                </tr>

                <tr>
                  <td><b>MAIL_HOST</b></td>
                  <td>
                    Mail Host- <br><br>
                    <code>smtp.gmail.com</code><br><br> 
                    or like<code>mail.domain.com</code>
                  </td>
                </tr>

                <tr>
                  <td><b>MAIL_PORT</b></td>
                  <td><code>587 or other</code></td>
                </tr>

                <tr>
                  <td><b>MAIL_USERNAME</b></td>
                  <td>Mail user name</td>
                </tr>

                <tr>
                  <td><b>MAIL_PASSWORD</b></td>
                  <td>Mail password</td>
                </tr>

                <tr>
                  <td><b>MAIL_ENCRYPTION</b></td>
                  <td><code>tls</code> or others</td>
                </tr>
                <tr>
                  <td><b>Cache Clear</b></td>
                  <td>
                    <code>php artisan config:cache</code> <br><br>
                    <code>php artisan cache:clear</code>
                  </td>
                </tr>

                

                {{--  <tr>
                  <td><b></b></td>
                  <td></td>
                </tr>  --}}
              </tbody>
            </table>
          </div>

          <hr>
            
           
          <div class="form-group row col-md-12 required">
              <label for="environmentVariablesData" class="col-md-2 col-form-label text-md-right control-label">
                Environment Variable
              </label>

              <div class="col-md-10">
                  <textarea id="environmentVariablesData" name="environmentVariablesData" v-model="environmentVariablesData"  class="form-control"     rows="60" required></textarea>
              </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-md-offset-4 mt-2">
                <button type="submit" class="btn btn-success float-right" id="systemEnvironmentDataUpdate" @click="systemEnvironmentDataUpdate()">
                    Update
                </button>
            </div>
          </div>

          
            

        </div>
    </div>
</div>


@if ( preg_match("/127.0/", Request::ip()) )
  <script src="{{ asset('js/vue.js') }}"></script>
@else
  <script src="{{ asset('js/vue.min.js') }}"></script>
@endif


<script src="{{ asset('js/axios.min.js') }}"></script>





<script>

  var _this = this
  
  var app = new Vue({
    el: '#app',
    data: {
      environmentVariablesData: '',
      isValidToAccess: false

    },
    mounted() {
     this.passwordMatchInitializer()
    },
    methods: {

      passwordMatchInitializer(){
        var confirmData = prompt("Give most protected password to enter: ")
        if(confirmData){
          this.md5MatchForMostProtectedPassword(confirmData)
        }
        else{
          window.location = "{!! route('home') !!}"
        }
      },

      md5MatchForMostProtectedPassword(password){
        var _this = this

        axios.post('/superadmin/md5MatchForMostProtectedPassword', {password: password})
        .then(function (response) {
          _this.isValidToAccess = true

          _this.systemEnvironmentData()
        })
        .catch(function (error) {
          alert('wrong password')
          _this.passwordMatchInitializer()
        })
      },

      systemEnvironmentData(){
        var _this = this

        axios.post('/api/systemEnvironmentData')
        .then(function (response) {
          _this.environmentVariablesData = response.data.data
        })
        .catch(function (error) {
         
        })
      },

      systemEnvironmentDataUpdate(){
        if(this.environmentVariablesData)
        {
          var _this = this
          axios.post('/api/systemEnvironmentDataUpdate', {environmentVariablesData : this.environmentVariablesData})
          .then(function (response) {
            alert("Success")
            _this.environmentVariablesData = response.data.data
          })
          .catch(function (error) {
            alert("Failure")
          })
        }
      },

    },
    computed: {
     


    },

    watch: {
      
    },
    

  })
</script>

@endsection