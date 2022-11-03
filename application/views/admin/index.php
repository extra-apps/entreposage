<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Accueil | admin</title>
    <?= $this->load->view('inc/css', null, true); ?>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <?= $this->load->view('admin/sidebar', null, true); ?>

        <div class="page-container">
            <?= $this->load->view('admin/header', null, true); ?>

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Tableau de bord</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= count($this->db->get('client')->result()) ?></h2>
                                                <span>Clients</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="far fa-check-square"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= count($this->db->get('verificateur')->result()) ?></h2>
                                                <span>Vérificateurs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= count($this->db->get('declarant')->result()) ?></h2>
                                                <span>Déclarants</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fa fa-list"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= count($this->db->join('declaration', 'declaration.idmarchandise=marchandise.idmarchandise')->get('marchandise')->result()) ?></h2>
                                                <span>Marchandises déclarées</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Statistiques</h3>
                                        <div class="recent-report__chart">
                                            <canvas id="graph"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © <?= date('Y') ?> Entreposage</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?= $this->load->view('inc/js', null, true); ?>
    <script>
        $(function() {
            var ctx = document.getElementById("graph");
            if (ctx) {
                ctx.height = 300;
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembrer", "Octobre", "Novembre", "Decembre"],
                        defaultFontFamily: "Poppins",
                        datasets: [{
                                label: "Marchandises",
                                borderColor: "rgba(0,0,0,.09)",
                                borderWidth: "1",
                                backgroundColor: "rgba(0,0,0,.07)",
                                data: <?= $tab1 ?>
                            },
                            {
                                label: "Marchandises déclarées",
                                borderColor: "rgba(255,0 , 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(239, 51, 64, 0.7)",
                                pointHighlightStroke: "rgba(26,179,148,1)",
                                data: <?= $tab2 ?>
                            }
                        ]
                    },
                    options: {
                        legend: {
                            position: 'top',
                            labels: {
                                fontFamily: 'Poppins'
                            }

                        },
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontFamily: "Poppins"

                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    fontFamily: "Poppins"
                                }
                            }]
                        }

                    }
                });
            }
        })
    </script>

</body>

</html>