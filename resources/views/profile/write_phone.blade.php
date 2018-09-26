@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/intlTelInput.min.css')}}">
@stop

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel verification-form-panel">
                    <div class="panel-heading text-center">
                        <h3>
                            {{ trans('laravel-verification.phone_title') }}
                        </h3>
                        <p class="text-center">
                            <em>
                                {{ trans('laravel-verification.phone_subtitle') }}
                            </em>
                        </p>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('send-phone-code')}}" class="form-horizontal write-phone"
                              method="POST">
                            @csrf

                            <div class="form-group  ">
                                <div class="col-xs-12">
                                    <input id="phone" name="number" value="{{Auth::user()->phone}}" class="form-control required">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-8 col-xs-offset-2 text-center submit-container">
                                        <button type="submit"
                                                class="btn btn-lg btn-success btn-block"
                                                id="submit_verification" tabindex="7">
                                            {{ trans('laravel-verification.get_verification_code') }}
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

@endsection

@section('js')

    <script src="{{asset('js/intlTelInput.min.js')}}"></script>

    <script>
        $("#phone").intlTelInput({
            // allowDropdown: false,
            autoHideDialCode: true,
            autoPlaceholder: true,
            dropdownContainer: "body",
            excludeCountries: ["us"],
            formatOnDisplay: false,
            geoIpLookup: function (callback) {
                $.get("http://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            hiddenInput: "phone",
            initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            separateDialCode: true,
            utilsScript: "{{asset('js/utils.js')}}"
        });

        $('.write-phone').submit(function (form) {
            form.preventDefault();
            var endpoint = $(this).attr('action');
            var data = $(this).serialize();

            swal({
                allowOutsideClick: false,
                grow: false,
                animation: false,
                onOpen: () => {
                    swal.showLoading();
                    $.ajax(
                        {
                            type: "post",
                            url: endpoint,
                            data: data,
                            success: function (response) {
                                swalCallback(response)
                            }
                        }
                    )
                }
            });

            function swalCallback(response, resend = false) {
                if (response.errors && !resend) {
                    swal({
                        text: response.message,
                        type: 'error',
                    })
                } else {
                    if (response.redirect) {
                        swal({
                            text: response.message,
                            type: 'success',
                            timer: 2000,
                            onClose: () => {
                                location.href = response.redirect
                            }
                        })
                    } else {
                        swal({
                            type: (resend ? 'error' : 'info'),
                            text: response.message,
                            input: 'number',
                            inputAttributes: {
                                autocapitalize: 'off',
                                name: 'code'
                            },
                            confirmButtonText: "{{__('generic.confirm')}}",
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                return $.ajax({
                                    url: "{{route('confirm-code')}}",
                                    type: 'post',
                                    data: {code: $('input[name="code"]').val()},
                                    success: function (result) {
                                        return result;
                                    }
                                });
                            },
                            allowOutsideClick: () => !swal.isLoading()
                        }).then((result) => {
                            swalCallback(result.value, true);

                        })
                    }

                }
            }

            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
            });
        });
    </script>

@endsection
