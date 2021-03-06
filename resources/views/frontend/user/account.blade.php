@extends('frontend.layouts.app')

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.user.account') }}</div>

                <div class="panel-body">

                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" id="li-profile">
                                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="tabs">{{ trans('navs.frontend.user.profile') }}</a>
                            </li>

                            <li role="presentation" id="li-edit">
                                <a href="#edit" aria-controls="edit" role="tab" data-toggle="tab" class="tabs">{{ trans('labels.frontend.user.profile.update_information') }}</a>
                            </li>

                            @if ($logged_in_user->canChangePassword())
                                <li role="presentation" id="li-password">
                                    <a href="#password" aria-controls="password" role="tab" data-toggle="tab" class="tabs">{{ trans('navs.frontend.user.change_password') }}</a>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane mt-30 active" id="profile">
                                @include('frontend.user.account.tabs.profile')
                            </div><!--tab panel profile-->

                            <div role="tabpanel" class="tab-pane mt-30" id="edit">
                                @include('frontend.user.account.tabs.edit')
                            </div><!--tab panel profile-->

                            @if ($logged_in_user->canChangePassword())
                                <div role="tabpanel" class="tab-pane mt-30" id="password">
                                    @include('frontend.user.account.tabs.change-password')
                                </div><!--tab panel change password-->
                            @endif

                            @include('frontend.user.account.upload-photo-modal')

                        </div><!--tab content-->

                    </div><!--tab panel-->

                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-xs-12 -->

    </div><!-- row -->
@endsection

@section('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {

        // To Use Select2
        FinBuilders.Select2.init();
        
        if($.session.get("tab") == "edit")
        {
            $("#li-password").removeClass("active");
            $("#li-profile").removeClass("active");
            $("#li-edit").addClass("active");

            $("#profile").removeClass("active");
            $("#password").removeClass("active");
            $("#edit").addClass("active");
        }
        else if($.session.get("tab") == "password")
        {
            $("#li-password").addClass("active");
            $("#li-profile").removeClass("active");
            $("#li-edit").removeClass("active");

            $("#profile").removeClass("active");
            $("#password").addClass("active");
            $("#edit").removeClass("active");
        }

        //Getting States of default contry
        ajaxCall("{{route('frontend.get.states')}}");

    

        //Getting Cities of select State
        $("#state").on("change", function() {
            var stateId = $(this).val();
            var url = "{{route('frontend.get.cities')}}";
            ajaxCall(url, stateId);
        });

        function ajaxCall(url, data = null)
        {
            $.ajax({
                url: url,
                type: "POST",
                data: {stateId: data},
                success: function(result) {
                    if(result != null)
                    {
                        if(result.status == "city")
                        {
                            var userCity = "{{ $logged_in_user->city_id }}";
                            var options;
                            $.each(result.data, function(key, value) {
                                if(key == userCity)
                                    options += "<option value='" + key + "' selected>" + value + "</option>";
                                else
                                    options += "<option value='" + key + "'>" + value + "</option>";
                            });
                            $("#city").html('');
                            $("#city").append(options);
                        }
                        else
                        {
                            var userState = "{{ $logged_in_user->state_id }}";
                            var options;
                            $.each(result.data, function(key, value) {
                                if(key == userState)
                                    options += "<option value='" + key + "' selected>" + value + "</option>";
                                else
                                    options += "<option value='" + key + "'>" + value + "</option>";
                            });
                            $("#state").append(options);
                            $("#state").trigger('change');
                        }
                    }
                }
            });
        }

        $(".tabs").click(function() {
            var tab = $(this).attr("aria-controls");
            $.session.set("tab", tab);
        });
    });
</script>
@endsection