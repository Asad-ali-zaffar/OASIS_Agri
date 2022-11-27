@stack('js')

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('plugins/datetimepickerNew/js/datetimepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.js') }}"></script>
<!-- DataTables -->
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js') }}" type="text/javascript">
</script>
<script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
{{-- datatable buttons cdn --}}
{{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script> --}}
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
<!-- Toastr-->
<script src="{{ url('js/toastr.min.js') }}"></script>
<!-- Validate -->
<script src="{{ url('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ url('plugins/print/jQuery.print.min.js') }}"></script>
<script src="{{ url('js/jquery.classyqr.min.js') }}"></script>
<script src="{{ url('js/select2.js') }}"></script>
<script src="{{ url('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
{{-- <script src="{{ url('plugins/sweetalert2/sweetalert.init.js') }}"></script> --}}
<!-- Url for ajax -->
<script>
    $('.datetimepicker').dateTimePicker({
        positionShift: {
            top: 20,
            left: 0
        },
        title: "Select Date and Time",
        buttonTitle: "Select"
    });

    // var ajaxUrl = 'labs/';
    // @if (strpos(Config::get('app.url'), 'global_labs') !== false)
    //     var ajaxUrl = 'global_labs/';
    // @endif

    //var db_url = 'https://labs.tekrons.com.pk/'+ajaxUrl+'admin/';
    // var db_url = 'http://127.0.0.1:8000/admin/';
</script>

<!-- Scripts Translation -->
<script>
    var translations = `{"Login Patient":"Login Patient","Patient Code":"Patient Code","Remember Me":"Remember Me","Forgot Code ?":"Forgot Code ?","Login":"Login","New Patient ?":"New Patient ?","Follow Us":"Follow Us","New Patient":"New Patient","Name":"Name","Gender":"Gender","Male":"Male","Female":"Female","Phone":"Phone","Email":"Email","Date Of Birth":"Date Of Birth","Address":"Address","Signup":"Signup","Send Patient Code":"Send Patient Code","Send":"Send","Email Or Phone":"Email Or Phone","Login Admin":"Login Admin","Password":"Password","Forgot Password?":"Forgot Password?","Send Ressetting Mail":"Send Ressetting Mail","Resetting Admin Password":"Resetting Admin Password","New Password":"New Password","New Password Confirmation":"New Password Confirmation","Reset Password":"Reset Password","Dashboard":"Dashboard","Total Reports":"Total Reports","Pending Reports":"Pending Reports","Completed Reports":"Completed Reports","Code":"Code","Profile":"Profile","Reports":"Reports","Tests Library":"Tests Library","Home Visit":"Home Visit","Home Visits":"Home Visits","Our Branches":"Our Branches","Email Address":"Email Address","Select Gender":"Select Gender","Date":"Date","Total":"Total","Paid":"Paid","Due":"Due","Done":"Done","Action":"Action","Reports list":"Reports list","Shortcut":"Shortcut","Sample Type":"Sample Type","precautions":"precautions","Tests":"Tests","Cultures":"Cultures","Request a home visit":"Request a home visit","New patient":"New patient","Location On Map":"Location On Map","Attachment":"Attachment","Attachment Image":"Attachment Image","Browse":"Browse","optional":"optional","View On Map":"View On Map","Are you sure to delete branch ?":"Are you sure to delete branch ?","Cancel":"Cancel","Delete":"Delete","Copy":"Copy","Excel":"Excel","CVS":"CVS","PDF":"PDF","Processing...":"Processing...","No data available in table":"No data available in table","Showing":"Showing","to":"to","of":"of","from":"from","filtered":"filtered","Show":"Show","Search":"Search","No matching records found":"No matching records found","First":"First","Last":"Last","Next":"Next","Previous":"Previous","records":"records","Are you sure to delete component ?":"Are you sure to delete component ?","Please select at least one test component":"Please select at least one test component","No new messages":"No new messages","No new visits":"No new visits","Are you sure to delete antibiotic ?":"Are you sure to delete antibiotic ?","Are you sure to delete backup ?":"Are you sure to delete backup ?","Are you sure to delete contract ?":"Are you sure to delete contract ?","Are you sure to delete culture option ?":"Are you sure to delete culture option ?","Are you sure to delete option ?":"Are you sure to delete option ?","Are you sure to delete culture ?":"Are you sure to delete culture ?","No users online":"No users online","Are you sure to delete doctor ?":"Are you sure to delete doctor ?","Select expense category":"Select expense category","Category added successfully":"Category added successfully","Success":"Success","Something went wrong":"Something went wrong","Are you sure to delete expense ?":"Are you sure to delete expense ?","Select contract":"Select contract","Patient Name":"Patient Name","Patient saved successfully":"Patient saved successfully","Are you sure to delete group ?":"Are you sure to delete group ?","Please select at least one test":"Please select at least one test","Are you sure to delete group test ?":"Are you sure to delete group test ?","Are you sure to delete patient ?":"Are you sure to delete patient ?","Password confirmation does not match password":"Password confirmation does not match password","Select antibiotic":"Select antibiotic","Select sensitivity":"Select sensitivity","Please select at least one antibiotic":"Please select at least one antibiotic","Select Sensitivity":"Select Sensitivity","High":"High","Moderate":"Moderate","Resident":"Resident","Are you sure to delete role ?":"Are you sure to delete role ?","Are you sure to delete test ?":"Are you sure to delete test ?","Are you sure to delete user ?":"Are you sure to delete user ?","Are you sure to delete visit ?":"Are you sure to delete visit ?","Failed":"Failed","Edit Profile":"Edit Profile","Filters":"Filters","Status":"Status","All":"All","Pending":"Pending","Current patient":"Current patient","Save":"Save","New here ?":"New here ?","Create Account":"Create Account","Submit":"Submit","Wrong email or password":"Wrong email or password","Please check your email to complete resetting your password":"Please check your email to complete resetting your password","Email not found":"Email not found","Password reset successfully":"Password reset successfully","Patient registered successfully":"Patient registered successfully","Login success":"Login success","Wrong patient code":"Wrong patient code","we sent you the patient code,Please check your mail or phone for the patient code message":"we sent you the patient code,Please check your mail or phone for the patient code message","Wrong patient email or phone":"Wrong patient email or phone","Home":"Home","Filter":"Filter","Activity log cleared successfully":"Activity log cleared successfully","Antibiotic saved successfully":"Antibiotic saved successfully","Antibiotic updated successfully":"Antibiotic updated successfully","Antibiotic deleted successfully":"Antibiotic deleted successfully","Database backup created successfully":"Database backup created successfully","Backup deleted successfully":"Backup deleted successfully","Branch created successfully":"Branch created successfully","Branch updated successfully":"Branch updated successfully","Branch deleted successfully":"Branch deleted successfully","Test created successfully":"Test created successfully","Test updated successfully":"Test updated successfully","Test deleted successfully":"Test deleted successfully","Culture created successfully":"Culture created successfully","Culture updated successfully":"Culture updated successfully","Culture deleted successfully":"Culture deleted successfully","Contract created successfully":"Contract created successfully","Contract updated successfully":"Contract updated successfully","Contract deleted successfully":"Contract deleted successfully","Culture option created successfully":"Culture option created successfully","Culture option updated successfully":"Culture option updated successfully","Culture option deleted successfully":"Culture option deleted successfully","Doctor created successfully":"Doctor created successfully","Doctor updated successfully":"Doctor updated successfully","Doctor deleted successfully":"Doctor deleted successfully","Expense category created successfully":"Expense category created successfully","Expense category updated successfully":"Expense category updated successfully","Expense category deleted successfully":"Expense category deleted successfully","Expense created successfully":"Expense created successfully","Expense updated successfully":"Expense updated successfully","Expense deleted successfully":"Expense deleted successfully","Group created successfully":"Group created successfully","Group updated successfully":"Group updated successfully","Group deleted successfully":"Group deleted successfully","User created successfully":"User created successfully","User updated successfully":"User updated successfully","User deleted successfully":"User deleted successfully","Role created successfully":"Role created successfully","Role updated successfully":"Role updated successfully","Role deleted successfully":"Role deleted successfully","Patient created successfully":"Patient created successfully","Patient updated successfully":"Patient updated successfully","Patient deleted successfully":"Patient deleted successfully","Visit created successfully":"Visit created successfully","Visit updated successfully":"Visit updated successfully","Visit deleted successfully":"Visit deleted successfully","Tests prices updated successfully":"Tests prices updated successfully","Cultures prices updated successfully":"Cultures prices updated successfully","Profile updated successfully":"Profile updated successfully","Test result saved successfully":"Test result saved successfully","Culture result saved successfully":"Culture result saved successfully","Your home visit request sent successfully , please be patient till our representative contact you":"Your home visit request sent successfully , please be patient till our representative contact you","Password Confirmation":"Password Confirmation","Price":"Price","Precautions":"Precautions","Test Components":"Test Components","Component":"Component","Title":"Title","Unit":"Unit","Reference Range":"Reference Range","Separated":"Separated","status":"status","Text":"Text","Select":"Select","Option":"Option","Create Test":"Create Test","Create":"Create","Edit":"Edit","Edit Test":"Edit Test","Tests Table":"Tests Table","Category":"Category","Expense category name":"Expense category name","Create Expense Category":"Create Expense Category","Expense Categories":"Expense Categories","Edit Expense Category":"Edit Expense Category","Not Listed ?":"Not Listed ?","Amount":"Amount","Notes":"Notes","New Expense Category":"New Expense Category","Category name":"Category name","Close":"Close","Create Expense":"Create Expense","Expenses":"Expenses","Edit Expense":"Edit Expense","Expenses Table":"Expenses Table","Date range":"Date range","Doctor":"Doctor","Test":"Test","Culture":"Culture","Show Details":"Show Details","Show Group tests":"Show Group tests","Show Expenses":"Show Expenses","Show Profit":"Show Profit","Accounting":"Accounting","Accounting Report":"Accounting Report","Group Tests":"Group Tests","Profit":"Profit","Activity Logs":"Activity Logs","Activity Logs Table":"Activity Logs Table","Clear":"Clear","User":"User","Time":"Time","Commercial Name":"Commercial Name","Create Antibiotic":"Create Antibiotic","Antibiotics":"Antibiotics"}`;

    function trans(key) {
        var trans = JSON.parse(translations);
        return (trans[key] != null ? trans[key] : key);
    }
</script>
<!-- Main dashboard -->
{{-- @if (auth()->guard('admin')->check()) --}}
<script src="{{ url('js/admin/main.js') }}"></script>
{{-- @else
  <script src="{{ url('js/patient/main.js')}}"></script>
@endif --}}


<!-- Flash messages -->
<script>
    @if (session()->has('success'))
        toastr_success(trans("{{ Session::get('success') }}"));
    @endif
    @if (Session()->has('failed') || session()->has('errors'))
        toastr_error(trans("{{ Session::get('failed') }}"));
    @endif
</script>
