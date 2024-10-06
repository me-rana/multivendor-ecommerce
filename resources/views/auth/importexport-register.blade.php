@extends('layouts.frontend.app')

@section('title', 'Shopping Now')

@section('content')
<style>
    form .form2{
        box-shadow: 0px 0px 5px gainsboro;
padding: 20px;
border-radius: 5px;

    }
</style>
@push('css')
    <style>
        span.select2.select2-container{width: 100% !important}
        .login-box, .register-box {
            width: 450px !important;
        }
        @media (max-width: 576px) {
            .login-box, .register-box {
                margin-top: .5rem;
                width: 90% !important;
            }
        }
            ul.cc li{
            display: inline-block;
text-align: center;
background: var(--primary_color);
padding: 7px;
        }
        ul.cc li a{
            color: white;
            display: block;
        }
        ul.cc{
            padding: 0;
        }
    </style>
@endpush

    <br>

<div class="wrapper">
  <!--   <p style="text-align: center;">
        <a href="{{route('home')}}">
            <img style="width: 120px;padding: 10px 0px;" src="{{asset('uploads/setting/'.setting('auth_logo'))}}" alt="">
        </a>
    </p> -->

    <form class="col-md-6 offset-md-3" action="{{route('registeredImportExport')}}" method="post" enctype="multipart/form-data">
        @csrf
         <ul class="cc row">
        <li class="col-6" ><a href="{{route('ImportExport.login')}}">Importer/Exporter Login</a></li>
        <li class="col-6"   style="background:#32014e;color: white;"><a>Importer/Exporter Register</a></li>
    </ul>
        <div class="form form2 ">
            

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
    
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
    
            <!-- Address -->
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
    
            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
    
            <!-- Importer/Exporter -->
            <div class="form-group">
                <label for="importer_exporter">Are you an importer or an exporter?</label>
                <select class="form-control" id="importer_exporter" name="importer_exporter" required>
                    <option value="importer">Importer</option>
                    <option value="exporter">Exporter</option>
                </select>
            </div>
    
            <!-- What would you like to import -->
            <div class="form-group">
                <label for="import_item">What would you like to import?</label>
                <textarea class="form-control" id="import_item" name="import_item" rows="2"></textarea>
            </div>
    
            <!-- Import permit question -->
            <div class="form-group">
                <label>Do you have an Import permit?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="permit_yes" name="import_permit" value="yes">
                    <label class="form-check-label" for="permit_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="permit_no" name="import_permit" value="no">
                    <label class="form-check-label" for="permit_no">No</label>
                </div>
            </div>
    
            <!-- Permit type if yes -->
            <div class="form-group" id="permit_details" style="display:none;">
                <label for="permit_type">Type of permit you have:</label>
                <input type="text" class="form-control" id="permit_type" name="permit_type">
            </div>
    
            <!-- National ID upload -->
            <div class="form-group">
                <label for="national_id">Please upload National ID:</label>
                <input type="file" class="form-control-file" id="national_id" name="national_id" accept="image/*,.pdf" required>
            </div>
    
            <!-- Trade License -->
            <div class="form-group">
                <label>Do you have a Business Licence?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="trade_lic_yes" name="trade_license" value="yes">
                    <label class="form-check-label" for="trade_lic_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="trade_lic_no" name="trade_license" value="no">
                    <label class="form-check-label" for="trade_lic_no">No</label>
                </div>
            </div>
    
            <!-- Upload Trade Licence if yes -->
            <div class="form-group" id="trade_lic_upload" style="display:none;">
                <label for="trade_license_file">Please upload Trade Licence:</label>
                <input type="file" class="form-control-file" id="trade_license_file" name="trade_license_file" accept="image/*,.pdf">
            </div>
    
            <input  class="form-control" type="submit" value="Submit">
        </div>
        
    </form>
    <br>
    <span style="display: block;text-align: center;">Already have an Account? <a href="{{route('ImportExport.login')}}">Login (Importer/Exporter)</a></span>
</div>
<input type="hidden" value="{{ csrf_token() }}" name="cr" id="cr">
@endsection

@push('js')
<script>
   $(document).on('click', '#otp-send', function() {
                
                var number = document.getElementById('phone').value;
                var cr = document.getElementById('cr').value;
                $.ajax({
                    type: 'POST',
                    url: 'register/send-otp',
                    data: {
                        'number': number,
                        '_token': cr,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        $('#sm').html(response);
                   }
                });
            });

</script>
<script>
    // Show/hide permit type input if "yes" is selected
    document.querySelectorAll('input[name="import_permit"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('permit_details').style.display = this.value === 'yes' ? 'block' : 'none';
        });
    });

    // Show/hide trade license upload if "yes" is selected
    document.querySelectorAll('input[name="trade_license"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('trade_lic_upload').style.display = this.value === 'yes' ? 'block' : 'none';
        });
    });
</script>
@endpush