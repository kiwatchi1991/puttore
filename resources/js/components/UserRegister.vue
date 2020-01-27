<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">aaponent</div>

          <div class="card-body">{{ test }}</div>
        </div>
      </div>
    </div>
  </div>
<div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="account_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('account_Id') }}</label>

                            <div class="col-md-6">
                                <input id="account_id" type="text"
                                    class="form-control @error('account_id') is-invalid @enderror" name="account_id"
                                    value="{{ old('account_id') }}" required autocomplete="account_id" autofocus>

                                @error('account_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>

</template>

<script>
export default {
  props:{
        test: String,
    },
  mounted() {
    console.log('Component mounted.');
  }
};
</script>
