
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <i id="closeBtn" class="bi bi-x-circle-fill" onclick="closeBtn(this.parentElement);"  type="button" class="close" aria-label="close" data-dismiss="alert"></i>
        <span>{{ $message }}</span>
    </div>
@endif
