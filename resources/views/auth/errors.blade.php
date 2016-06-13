@unless(empty($errors->all()))
  <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h4><i class="fa fa-warning"></i> Warning!</h4>
    <ul class="list-unstyled">
      <?php $dumpErrors = []; ?>
      @foreach($errors->all() as $pos=>$error)
        @if(!in_array($error,$dumpErrors))
          <li>{{$error}}</li>
          <?php $dumpErrors[] = $error; ?>
        @endif
      @endforeach
    </ul>
  </div>
@endunless