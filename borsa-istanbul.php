<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Demobist - Yatırım Simülasyonu</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.tailwindcss.com/2.2.19/tailwind.min.js"></script>


    <link href="style.css" rel="stylesheet" />
    <link href="tailwind.css" rel="stylesheet" />
</head>

<body>

    <?php

    require 'functions/bist-sql.php';
    require 'functions/bist100.php';
    $borsa_sql  = new bistSql();
    // PDO bağlantısı oluşturulması
    $conn = $borsa_sql->connectMysql();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "select * from bist";

    // Sorgunun hazırlanması
    $stmt = $conn->prepare($sql);
    // Sorgunun çalıştırılması
    $stmt->execute();

    // Sonuçların alınması
    $lots = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <nav class="bg-orange-200  w-full fixed p-2">
        <div class="mx-auto  max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start" id="anasayfa">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="index"><img class="h-10 w-auto" src="images/demobist-logo-kare.webp" alt="Your Company"></a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="borsa-istanbul" class="black text-black text-lg hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 font-medium underline decoration-1" aria-current="page"><strong>Borsa İstanbul</strong></a>
                            <a href="index#neden-demobist" class="black text-black hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">Neden
                                Demobist ?</a>
                            <a href="index#nasil-calisir" class="text-3xl hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">Nasıl
                                Çalışır ?</a>
                            <a href="index#amacimiz" class="text-3xl hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">Amacımız</a>
                            <a href="index#sikca-sorulan-sorular" class="text-3xl hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">S.S.S.</a>
                            <a href="index#iletisim" class="hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">İletişim</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <a href="giris" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium">
                        Kayıt Ol / Giriş Yap
                    </a>
                </div>
            </div>
        </div>

    </nav>

    <div class="container mx-auto p-4 pt-36">
        <h1 class="text-3xl font-bold mb-4">Borsa İstanbul Verileri</h1>

        <div class="mb-4">
            <input type="text" id="search" class="border rounded py-2 px-3 w-full" placeholder="Arama yap...">
        </div>

        <!-- Tablo -->

        <div class="overflow-x-auto">
            <table class="table-auto border-collapse border border-gray-500 w-full">
                <thead>
                    <tr class="bg-emerald-100">
                        <th class="px-4 py-4">Hisse Kodu</th>
                        <th class="px-4 py-4">Şirket Adı</h>
                        <th class="px-4 py-4">Son Fiyat</th>
                        <th class="px-4 py-4">Değişim</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="data">
                    <?php foreach ($lots as $lot) : ?>
                        <tr>
                            <td class="border  text-lg px-4 py-2"><?php echo $lot["hisse_adi"] ?></td>
                            <td class="border  text-lg px-4 py-2"><?php echo $bist_sirket_isimleri[$lot["hisse_adi"]] ?>
                            </td>
                            <td class="border  text-lg px-4 py-2"><?php echo $lot["hisse_deger"] ?></td>
                            <td class="border text-lg font-bold  px-4 py-2 
                        <?php
                        if ($lot["hisse_yuzde"] > 0) {
                            echo "text-green-600";
                        }
                        if ($lot["hisse_yuzde"] < 0) {
                            echo "text-red-600";
                        }
                        ?>
                        "><?php echo $lot["hisse_yuzde"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="bg-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center">
                <p class="text-gray-600">© 2024 Demobist. Tüm hakları saklıdır. Demobist, Morsoft girişimidir.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById("search").addEventListener("input", function() {
            var searchText = this.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g,
                ""); // Türkçe karakterleri dönüştürmek
            var rows = document.querySelectorAll("#data tr");

            rows.forEach(function(row) {
                var cells = row.querySelectorAll("td");
                var found = false;

                cells.forEach(function(cell) {
                    var cellText = cell.textContent.toLowerCase().normalize("NFD").replace(
                        /[\u0300-\u036f]/g, ""); // Türkçe karakterleri dönüştürmek
                    if (cellText.includes(searchText)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>

</body>


</html>