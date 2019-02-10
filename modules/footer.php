<?php
/**
 * Created by PhpStorm.
 * User: Rampesna
 * Date: 05.06.2018
 * Time: 09:21
 */
?>
<footer class="footer">
    <div class="footer__block block no-margin-bottom">
        <div class="container-fluid text-center">
            <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            <p class="no-margin-bottom" id="talha">2018 &copy; <span style="color: #e95f71;"> Talha Can </span>
                Tarafından Yapılmıştır. Tüm Hakları Saklıdır.</p>
        </div>
    </div>
</footer>
</div>
</div>


<script src="vendor/jquery/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<script>
    $('#stokurunler').DataTable({
        language: {
            info: "_TOTAL_ Kayıttan _START_ - _END_ Arasındaki Kayıtlar Gösteriliyor.",
            infoEmpty: "Gösterilecek Hiç Kayıt Yok.",
            loadingRecords: "Kayıtlar yükleniyor.",
            zeroRecords: "Tablo Boş",
            search: "Arama:",
            infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",

            /*

            buttons: {
                copyTitle: "Panoya Kopyalandı.",
                copySuccess:"Panoya %d Satır Kopyalandı",
                copy: "Kopyala",
                print: "Yazdır",
            },

*/
            paginate: {
                first: "İlk",
                previous: "Önceki",
                next: "Sonraki",
                last: "Son"
            },
        },
        dom: 'Bfrtip',

        /*

        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],

        */
        responsive: true
    });
</script>

<script>
    $('#telefon').keypress(function (e) {
        if (this.value.length == 0 && e.which == 48) {
            $(".help-block").fadeIn('slow').fadeOut('slow');
            return false;
        }
    });

</script>

<script>

    $(document).ready(function () {
        $("#telefon").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $("#isim").keypress(function (evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (((charCode <= 93 && charCode >= 65) || (charCode <= 122 && charCode >= 97) || charCode == 8) || charCode == 350 || charCode == 351 || charCode == 304 || charCode == 286 || charCode == 287 || charCode == 231 || charCode == 199 || charCode == 305 || charCode == 214 || charCode == 246 || charCode == 220 || charCode == 252) {
                return true;
            }
            return false;
        });
    });

    $(document).ready(function () {
        $("#soyisim").keypress(function (evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (((charCode <= 93 && charCode >= 65) || (charCode <= 122 && charCode >= 97) || charCode == 8) || charCode == 350 || charCode == 351 || charCode == 304 || charCode == 286 || charCode == 287 || charCode == 231 || charCode == 199 || charCode == 305 || charCode == 214 || charCode == 246 || charCode == 220 || charCode == 252) {
                return true;
            }
            return false;
        });
    });
</script>
<script>
    function kat_silindi() {
        alert("Kategori Silindi!");
    }

    function firma_silindi() {
        alert("Firma Silindi!");
    }

    function tip_silindi() {
        alert("Tip Silindi!");
    }
</script>
<script>
    $(document).ready(function () {
        $("#bilgi1").delay(1000);
        $("#bilgi1").fadeOut('slow');

        $("#bilgi2").delay(1500);
        $("#bilgi2").fadeOut('slow');

        $("#bilgi3").delay(2000);
        $("#bilgi3").fadeOut('slow');

        $("#bilgi4").delay(2500);
        $("#bilgi4").fadeOut('slow');

        $("#bilgi5").delay(3000);
        $("#bilgi5").fadeOut('slow');

    });

</script>

<script>
    var PIECHARTEXMPLE = $('#pieChartCustom1');
    var pieChartExample = new Chart(PIECHARTEXMPLE, {
        type: 'pie',
        options: {
            legend: {
                display: true,
                position: "left"
            }
        },
        data: {
            labels: [
                "KART",
                "TDM",
                "FİBER",
                "SFP"
            ],
            datasets: [
                {
                    data: [300, 50, 100, 80],
                    borderWidth: 0,
                    backgroundColor: [
                        '#723ac3',
                        "#864DD9",
                        "#9762e6",
                        "#a678eb"
                    ],
                    hoverBackgroundColor: [
                        '#723ac3',
                        "#864DD9",
                        "#9762e6",
                        "#a678eb"
                    ]
                }]
        }
    });

    var pieChartExample = {
        responsive: true
    };

</script>


<!-- JavaScript Dosyaları-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script src="vendor/popper.js/umd/popper.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="js/charts-home.js"></script>
<script src="js/front.js"></script>
<script src="js/charts-custom.js"></script>


</body>
</html>
