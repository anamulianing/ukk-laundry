<style>
  .info-box-number {
    color: black;
  }
  a:hover {
    color: #006eff;
  }
</style>
@props(['dataBox'=>[]])
<div class="col-lg-3 col-6">
  <div class="info-box mb-3">
    <span class="info-box-icon {{ $dataBox['background'] }} elevation-1"><i class="{{ $dataBox['icon'] }}"></i></span>

    <div class="info-box-content">
      
      <span class="info-box-text">{{ $dataBox['value'] }}</span>
      <a href="{{ $dataBox['href'] }}" class="info-box-number">
        {{ $dataBox['label'] }}
      </a>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>