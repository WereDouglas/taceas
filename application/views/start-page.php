<?php require_once(APPPATH . 'views/inner-css.php'); ?> 
<style>
    #page-wrapper {
    position: inherit;
    margin: 60 0 5 200px;
    padding: 0 30px;
    min-height: 1000px;
}
</style>
<div id="page-wrapper">
    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        <!--quick info section -->
        <div class="col-lg-3">
            <div class="alert alert-danger text-center">
                <i class="fa fa-calendar fa-2x"></i>&nbsp;<b>20 </b>Meetings Sheduled This Month

            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-success text-center">
                <i class="fa  fa-beer fa-2x"></i>&nbsp;<b>27 % </b>Profit Recorded in This Month  
            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-info text-center">
                <i class="fa fa-rss fa-2x"></i>&nbsp;<b>1,900</b> New Subscribers This Year

            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-warning text-center">
                <i class="fa  fa-pencil fa-2x"></i>&nbsp;<b>2,000 $ </b>Payment Dues For Rejected Items
            </div>
        </div>
        <!--end quick info section -->
    </div>

    <div class="row">
        <div class="col-lg-6">

            <div id="container2" style="min-width: 210px; height: 400px; margin: 0 auto">

            </div>



        </div>

        <div class="col-lg-6">

            <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        </div>

    </div>

    <div class="row">
        <div class="col-lg-4">
            <div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        </div>
        <div class="col-lg-8">
            <div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

            <table id="datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Jane</th>
                        <th>John</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Apples</th>
                        <td>3</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <th>Pears</th>
                        <td>2</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Plums</th>
                        <td>5</td>
                        <td>11</td>
                    </tr>
                    <tr>
                        <th>Bananas</th>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th>Oranges</th>
                        <td>2</td>
                        <td>4</td>
                    </tr>
                </tbody>
            </table>


        </div>

    </div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#container4').highcharts({
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Data extracted from a HTML table in the page'
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Units'
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                }
            }
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#container3').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'US and USSR nuclear stockpiles'
            },
            subtitle: {
                text: 'Source: <a href="http://thebulletin.metapress.com/content/c4120650912x74k7/fulltext.pdf">' +
                        'thebulletin.metapress.com</a>'
            },
            xAxis: {
                allowDecimals: false,
                labels: {
                    formatter: function () {
                        return this.value; // clean, unformatted number for year
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Nuclear weapon states'
                },
                labels: {
                    formatter: function () {
                        return this.value / 1000 + 'k';
                    }
                }
            },
            tooltip: {
                pointFormat: '{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
            },
            plotOptions: {
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [{
                    name: 'USA',
                    data: [null, null, null, null, null, 6, 11, 32, 110, 235, 369, 640,
                        1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468, 20434, 24126,
                        27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342, 26662,
                        26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
                        24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586,
                        22380, 21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950,
                        10871, 10824, 10577, 10527, 10475, 10421, 10358, 10295, 10104]
                }, {
                    name: 'USSR/Russia',
                    data: [null, null, null, null, null, null, null, null, null, null,
                        5, 25, 50, 120, 150, 200, 426, 660, 869, 1060, 1605, 2471, 3322,
                        4238, 5221, 6129, 7089, 8339, 9399, 10538, 11643, 13092, 14478,
                        15915, 17385, 19055, 21205, 23044, 25393, 27935, 30062, 32049,
                        33952, 35804, 37431, 39197, 45000, 43000, 41000, 39000, 37000,
                        35000, 33000, 31000, 29000, 27000, 25000, 24000, 23000, 22000,
                        21000, 20000, 19000, 18000, 18000, 17000, 16000]
                }]
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#container2').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: 'Ticket Sale Count Distribution'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [
                        ['Firefox', 45.0],
                        ['IE', 26.8],
                        {
                            name: 'Chrome',
                            y: 12.8,
                            sliced: true,
                            selected: true
                        },
                        ['Safari', 8.5],
                        ['Opera', 6.2],
                        ['Others', 0.7]
                    ]
                }]
        });
    });
</script>
<script type="text/javascript">
// Data retrieved from http://vikjavev.no/ver/index.php?spenn=2d&sluttid=16.06.2015.
    $(function () {
        $('#container1').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Wind speed during two days'
            },
            subtitle: {
                text: 'May 31 and and June 1, 2015 at two locations in Vik i Sogn, Norway'
            },
            xAxis: {
                type: 'datetime',
                labels: {
                    overflow: 'justify'
                }
            },
            yAxis: {
                title: {
                    text: 'Wind speed (m/s)'
                },
                minorGridLineWidth: 0,
                gridLineWidth: 0,
                alternateGridColor: null,
                plotBands: [{// Light air
                        from: 0.3,
                        to: 1.5,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label: {
                            text: 'Light air',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {// Light breeze
                        from: 1.5,
                        to: 3.3,
                        color: 'rgba(0, 0, 0, 0)',
                        label: {
                            text: 'Light breeze',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {// Gentle breeze
                        from: 3.3,
                        to: 5.5,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label: {
                            text: 'Gentle breeze',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {// Moderate breeze
                        from: 5.5,
                        to: 8,
                        color: 'rgba(0, 0, 0, 0)',
                        label: {
                            text: 'Moderate breeze',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {// Fresh breeze
                        from: 8,
                        to: 11,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label: {
                            text: 'Fresh breeze',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {// Strong breeze
                        from: 11,
                        to: 14,
                        color: 'rgba(0, 0, 0, 0)',
                        label: {
                            text: 'Strong breeze',
                            style: {
                                color: '#606060'
                            }
                        }
                    }, {// High wind
                        from: 14,
                        to: 15,
                        color: 'rgba(68, 170, 213, 0.1)',
                        label: {
                            text: 'High wind',
                            style: {
                                color: '#606060'
                            }
                        }
                    }]
            },
            tooltip: {
                valueSuffix: ' m/s'
            },
            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        enabled: false
                    },
                    pointInterval: 3600000, // one hour
                    pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
                }
            },
            series: [{
                    name: 'Hestavollane',
                    data: [0.2, 0.8, 0.8, 0.8, 1, 1.3, 1.5, 2.9, 1.9, 2.6, 1.6, 3, 4, 3.6, 4.5, 4.2, 4.5, 4.5, 4, 3.1, 2.7, 4, 2.7, 2.3, 2.3, 4.1, 7.7, 7.1, 5.6, 6.1, 5.8, 8.6, 7.2, 9, 10.9, 11.5, 11.6, 11.1, 12, 12.3, 10.7, 9.4, 9.8, 9.6, 9.8, 9.5, 8.5, 7.4, 7.6]

                }, {
                    name: 'Vik',
                    data: [0, 0, 0.6, 0.9, 0.8, 0.2, 0, 0, 0, 0.1, 0.6, 0.7, 0.8, 0.6, 0.2, 0, 0.1, 0.3, 0.3, 0, 0.1, 0, 0, 0, 0.2, 0.1, 0, 0.3, 0, 0.1, 0.2, 0.1, 0.3, 0.3, 0, 3.1, 3.1, 2.5, 1.5, 1.9, 2.1, 1, 2.3, 1.9, 1.2, 0.7, 1.3, 0.4, 0.3]
                }],
            navigation: {
                menuItemStyle: {
                    fontSize: '10px'
                }
            }
        });
    });
</script>

<script src="<?= base_url(); ?>js/highcharts.js"></script>
<script src="<?= base_url(); ?>js/modules/data.js"></script>
<script src="<?= base_url(); ?>js/modules/exporting.js"></script>
<script src="<?= base_url(); ?>js/highcharts-3d.js"></script>


<script>
    $(document).ready(function () {
        document.body.style.zoom="70%"
      
    });

    

</script>
