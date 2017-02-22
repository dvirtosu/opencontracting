@extends('app')
@section('content')

    <div class="row about-page">
        <div class="inner-wrap-static">

            <div class="section-wrap">
                <h2>@lang('about.about_the_open_contracting_portal')</h2>
                @lang('about.about_first_paragraph')
            </div>

            <div class="section-wrap">
                <h2>@lang('about.about_open_contracting_in_moldova')</h2>
                @lang('about.about_second_paragraph')
            </div>

            <div class="section-wrap">
                <h2>@lang('about.additional_resources_for_developers')</h2>
                @lang('about.resources')
                <a href="http://tender.gov.md/en"><img src="{{url('images/ppa_logo.png')}}"></a>
                <a href="http://www.worldbank.org/ "><img style="margin-bottom: 20px;margin-left: 19px;" src="{{url('images/twb_logo.png')}}"></a>
            </div>

            <div class="section-wrap">
                @lang('about.credit')
            </div>
        </div>
    </div>
@stop
