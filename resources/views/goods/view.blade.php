@extends('app')
@section('content')
    <div class="block header-block header-with-bg">
        <div class="row header-with-icon">
            <h2><span><img src="{{url('images/ic_good_service.svg')}}"/></span>
                {{ $goods }}</h2>
        </div>
    </div>

    <div class="row medium-up-2 small-up-1 push-up-block name-value-section">
        <div class="name-value-wrap columns each-detail-wrap">
            <div class="name">
                @lang('goods.total_contract')
            </div>
            <div class="value">
                {{ count($goodsDetail) }}
            </div>
        </div>

        <div class="name-value-wrap columns each-detail-wrap">
            <div class="name">
                @lang('goods.total_contract_amount')
            </div>
            <div class="value">
                {{number_format($totalAmount)}} leu
            </div>
        </div>
    </div>

    <div class="row chart-section-wrap">
        <div class="inner-wrap clearfix" data-equalizer="equal-chart-wrap">
            <div data-equalizer="equal-header">
                <div class="medium-6 small-12 columns">
                    <div class="each-chart-section">
                        <div class="section-header clearfix" data-equalizer-watch="equal-header">
                            <h3>@lang('goods.no_of_contract')</h3>
                        </div>
                        <div class="chart-wrap default-view" data-equalizer-watch="equal-chart-wrap">
                            <div id="linechart-rest"></div>
                            <div class="loader-text">
                                <div class="text">@lang('general.fetching_data')
                                     <span>
                                    <div class="dot dot1"></div>
                                    <div class="dot dot2"></div>
                                    <div class="dot dot3"></div>
                                    <div class="dot dot4"></div>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="medium-6 small-12 columns">
                    <div class="each-chart-section">
                        <div class="section-header clearfix" data-equalizer-watch="equal-header">
                            <h3>@lang('general.contract_value')</h3>
                        </div>
                        <div class="chart-wrap default-view default-view" data-equalizer-watch="equal-chart-wrap">
                            <div id="barChart-amount"></div>
                            <div class="loader-text">
                                <div class="text">@lang('general.fetching_data')
                                     <span>
                                    <div class="dot dot1"></div>
                                    <div class="dot dot2"></div>
                                    <div class="dot dot3"></div>
                                    <div class="dot dot4"></div>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="inner-wrap clearfix" data-equalizer="equal-chart-wrap">
            <div data-equalizer="equal-header">
                <div class="medium-6 small-12 columns">
                    <div class="each-chart-section ">
                        <div class="section-header clearfix" data-equalizer-watch="equal-header">
                            <h3>@lang('homepage.top_5_contractors')</h3>
                        </div>
                        <div class="chart-wrap default-view default-barChart" data-equalizer-watch="equal-chart-wrap">
                            <div class="filter-section">
                                <form>
                                    <div>
                                        <label>
                                            <span class="inner-title">@lang('homepage.showing_contractors')</span>
                                            <select id="select-contractor-year">
                                                @include('selectYear')
                                            </select>
                                            <select id="select-contractor" data-for="goods" data="{{ $goods }}">
                                                <option value="amount" selected>Based on value</option>
                                                <option value="count">Based on count</option>
                                            </select>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="disabled-text">@lang('general.click_on_label_or_graph')</div>
                            <div id="barChart-contractors"></div>
                            <div class="loader-text">
                                <div class="text">@lang('general.fetching_data')
                                     <span>
                                    <div class="dot dot1"></div>
                                    <div class="dot dot2"></div>
                                    <div class="dot dot3"></div>
                                    <div class="dot dot4"></div>
                                </span>
                                </div>
                            </div>
                            <a href="{{route('contracts.contractorIndex')}}" class="anchor">@lang('homepage.view_all_contractors')<span>  &rarr; </span></a>
                        </div>
                    </div>
                </div>

                <div class="medium-6 small-12 columns">
                    <div class="each-chart-section">
                        <div class="section-header clearfix" data-equalizer-watch="equal-header">
                            <h3>@lang('general.top_5_procuring_agencies')</h3>
                        </div>
                        <div class="chart-wrap default-view default-barChart" data-equalizer-watch="equal-chart-wrap">
                            <div class="filter-section">
                                <form>
                                    <div>
                                        <label>
                                            <span class="inner-title">@lang('general.showing_procuring_agencies')</span>
                                            <select id="select-agency-year">
                                                @include('selectYear')
                                            </select>
                                            <select id="select-agency" data-for="goods" data="{{ $goods }}">
                                                <option value="amount" selected>Based on value</option>
                                                <option value="count">Based on count</option>
                                            </select>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="disabled-text">@lang('general.click_on_label_or_graph')</div>
                            <div id="barChart-procuring"></div>
                            <div class="loader-text">
                                <div class="text">@lang('general.fetching_data')
                                     <span>
                                    <div class="dot dot1"></div>
                                    <div class="dot dot2"></div>
                                    <div class="dot dot3"></div>
                                    <div class="dot dot4"></div>
                                </span>
                                </div>
                            </div>
                            <a href="{{ route('procuring-agency.index') }}" class="anchor">@lang('general.view_all_procuring_agencies')<span>  &rarr; </span></a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <div class="row table-wrapper">
        <a target="_blank" class="export" href="{{route('goodsDetail.export',['name'=>$goods])}}">@lang('general.export_as_csv')</a>
        <table id="table_id" class="responsive hover custom-table persist-area">

            <thead class="persist-header">
            <th>@lang('general.contract_number')</th>
            <th class="hide">@lang('general.contract_id')</th>
            <th>@lang('general.contractor')</th>
            <th>@lang('general.contract_status')</th>
            <th width="150px">@lang('general.contract_start_date')</th>
            <th width="150px">@lang('general.contract_end_date')</th>
            <th>@lang('general.amount')</th>
            </thead>
            <tbody>
            @forelse($goodsDetail as $tender)
                @foreach($tender['contracts'] as $key => $goods)
                    <tr>
                        <td>{{ getContractInfo($goods['title'],'id') }}</td>
                        <td class="hide">{{ $goods['id'] }}</td>
                        <td>{{ ($tender['awards'][$key]['suppliers'])?$tender['awards'][$key]['suppliers'][0]['name']:'-' }}</td>
                        <td class="dt">{{ $goods['status'] }}</td>
                        <td class="dt">{{ $goods['dateSigned'] }}</td>
                        <td class="dt">{{ $goods['period']['endDate'] }}</td>
                        <td>{{ number_format($goods['value']['amount']) }}</td>
                    </tr>
                @endforeach
            @empty
            @endforelse

            </tbody>
        </table>
    </div>

@stop
@section('script')
    <script src="{{url('js/vendorChart.min.js')}}"></script>
    <script src="{{url('js/responsive-tables.min.js')}}"></script>
    <script src="{{url('js/customChart.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            updateTables();
        });

        var createLinks = function () {

            $('#table_id tbody tr').each(function () {
                $(this).css('cursor', 'pointer');
                $(this).click(function () {
                    var contractId = $(this).find("td:nth-child(2)").text();
                    return window.location.assign(window.location.origin + "/contracts/" + contractId);
                });

            });
        };

        var makeTable = $("#table_id").DataTable({
            "bFilter": false,
            "fnDrawCallback": function () {
                changeDateFormat();
                createLinks();
                if ($('#table_id tr').length < 10 && $('a.current').text() === "1") {
                    $('.dataTables_paginate').hide();
                } else {
                    $('.dataTables_paginate').show();
                }
            }
        });

        createLinks();
    </script>
    <script src="{{url('js/fixedHeader.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            if ($(window).width() > 768) {
                new $.fn.dataTable.FixedHeader(makeTable);
            }
        });
    </script>
    <script>
        var route = '{{ route("filter") }}';
        var contracts = '{!! $contractTrend  !!}';
        var amountTrend = '{!! $amountTrend !!}';
        var contractors = '{!! $contractors  !!}';
        var procuringAgency = '{!! $procuringAgency  !!}';

        /* if(contracts == []){
         $(".each-chart-section").empty();
         }*/

        var makeCharts = function () {
            var widthofParent = $('.chart-wrap').width();
            createLineChartRest(JSON.parse(contracts), widthofParent);
            createBarChartContract(JSON.parse(amountTrend), "barChart-amount");
            createBarChartProcuring(JSON.parse(contractors), "barChart-contractors", "contracts/contractor", widthofParent, 'amount');
            createBarChartProcuring(JSON.parse(procuringAgency), "barChart-procuring", "procuring-agency", widthofParent, 'amount');
        };

        makeCharts();

        $(window).resize(function () {
            $("#linechart-rest").empty();
            $("#barChart-amount").empty();
            makeCharts();
        });

    </script>
@endsection
