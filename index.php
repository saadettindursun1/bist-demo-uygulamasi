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
                        <a href="#"><img class="h-10 w-auto" src="images/demobist-logo-kare.webp" alt="Your Company"></a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="borsa-istanbul" class="black text-black text-lg hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 font-medium underline decoration-1" aria-current="page"><strong>Borsa İstanbul</strong></a>
                            <a href="#neden-demobist" class="black text-black hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">Neden
                                Demobist ?</a>
                            <a href="#nasil-calisir" class="text-3xl hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">Nasıl
                                Çalışır ?</a>
                            <a href="#amacimiz" class="text-3xl hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">Amacımız</a>
                            <a href="#sikca-sorulan-sorular" class="text-3xl hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">S.S.S.</a>
                            <a href="#iletisim" class="hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-lg font-medium">İletişim</a>
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
    <div class="flex flex-wrap demobist-container demobist-gradient wave pt-36" style="height:100% !important;">
        <div class="w-3/5 mt-5">
            <div class="flex justify-between">
                <div>
                    <img src="images/demobist.png" class="demobist-logo" alt="" />
                </div>
                <div class="mr-56 mt-10 borsa-istanbul-logo">
                    <img src="images/borsa-istanbul-logo.png" class="" alt="" />
                </div>
            </div>
            <div class="w-4/5 mt-10">
                <span class="text-3xl border-b pb-1 text-white tracking-wide">Yatırıma Dair Sanal Deneyim, Başarıya
                    Giden Yol</span>
            </div>
            <div class="w-4/5 mt-5">
                <span class="text-2xl mt-3 text-white">Demobist, kullanıcılarına gerçekçi bir borsa deneyimi sunarak
                    finansal yeteneklerini geliştirmelerine yardımcı olur.
                </span>
            </div>
            <div class="demobist-inceleme flex mt-16 justify-items-start gap-16">
                <a href="#" class="inline-block font-bold bg-white border rounded-md px-16 py-4 flex items-center justify-center text-decoration-none">
                    HEMEN BAŞLA
                </a>
                <a href="#" class="inline-block border border-white rounded-md px-16 py-4 flex items-center justify-center text-white hover:bg-white hover:text-black hover:border-transparent transition-all duration-300">
                    DETAYLI İNCELE
                </a>
            </div>
        </div>
        <div class="w-2/5 demobist-banner">
            <img src="images/borsa-istanbul-demosu.png" class="" alt="" />
        </div>
    </div>

    <div class="row pt-20 pb-20 text-center demobist-kullanici-sayisi" id="neden-demobist">
        <span class="text-6xl">500.000+ Aktif Kullanıcı</span>
    </div>

    <div class="row demo-bist-bg demobist-neden">
        <div class="mx-auto max-w-screen-xl text-white text-center p-16">
            <h3 class="font-bold text-3xl">Neden Demobist?</h3>
            <ul class="list-none text-lg ml-4 list-inside mt-4">
                <li class="mb-2 relative">
                    <span class="mr-2 text-white font-bold text-2xl">✓</span> Platform,
                    gerçek piyasa koşullarını yansıtır, böylece kullanıcılar gerçek
                    zamanlı olarak finansal kararlar alabilirler.
                </li>
                <li class="mb-2 relative">
                    <span class="mr-2 text-white font-bold text-2xl">✓</span> Demobist,
                    kullanıcılara borsa ve yatırım stratejileri konusunda bilgi edinme
                    fırsatı sunar.
                </li>
                <li class="mb-2 relative">
                    <span class="mr-2 text-white font-bold text-2xl">✓</span>
                    Kullanıcılar, gerçek piyasa hareketlerini takip ederek farklı
                    stratejiler deneyebilir ve finansal okuryazarlıklarını
                    artırabilirler.
                </li>
                <li class="mb-2 relative">
                    <span class="mr-2 text-white font-bold text-2xl">✓</span>
                    Kullanıcılar, diğer yatırımcılarla fikir alışverişinde bulunabilir,
                    stratejilerini tartışabilir ve birbirlerinden öğrenebilirler.
                </li>
            </ul>
        </div>
        <div class="flex flex-wrap gap-10 justify-center p-12">
            <div class="w-1/5 bg-white flex flex-col text-center border border-white rounded-lg">
                <div class="demobist-icon flex justify-center">
                    <img src="images/icons/icon-1.svg" alt="" />
                </div>
                <h4 class="text-2xl font-bold mt-4">Gelişmiş Simülasyon</h4>
                <p class="p-6">
                    Demobist, finansal yeteneklerinizi gerçekçi bir ortamda ölçmek için
                    tasarlanmış yenilikçi bir platformdur.
                </p>
            </div>
            <div class="w-1/5 bg-white flex flex-col text-center border border-white rounded-lg">
                <div class="demobist-icon flex justify-center">
                    <img src="images/icons/icon-2.svg" alt="" />
                </div>
                <h4 class="text-2xl font-bold mt-4">Gerçek Hisseler</h4>
                <p class="p-6">
                    Platform, gerçek piyasa koşullarını yansıtır, böylece kullanıcılar
                    gerçek zamanlı olarak yatırım yapabilirler.
                </p>
            </div>
            <div class="w-1/5 bg-white flex flex-col text-center border border-white rounded-lg">
                <div class="demobist-icon flex justify-center">
                    <img src="images/icons/icon-3.svg" alt="" />
                </div>
                <h4 class="text-2xl font-bold mt-4">Topluluk Etkileşimi</h4>
                <p class="p-6">
                    Kullanıcılar, diğer yatırımcılarla fikir alışverişinde bulunabilir
                    ve stratejilerini tartışabilir.
                </p>
            </div>
            <div class="w-1/5 bg-white flex flex-col text-center border border-white rounded-lg">
                <div class="demobist-icon flex justify-center">
                    <img src="images/icons/icon-4.svg" alt="" />
                </div>
                <h4 class="text-2xl font-bold mt-4">Risksiz Pratik</h4>
                <p class="p-6">
                    Kullanıcılar finansal becerilerini geliştirirken borsa verilerini
                    kullanarak risk almadan pratik yapabilir.
                </p>
            </div>
        </div>
    </div>

    <div class="demobist-container text-center flex flex-row-reverse flex-wrap" id="nasil-calisir">
        <div class="w-1/2">
            <h3 class="text-3xl text-center font-bold">Nasıl Çalışır?</h3>
            <p class="text-left m-6">
                Kullanıcı Kaydı: Kullanıcılar,
                <strong> Demobist'e </strong> kaydolarak sanal hesaplarını
                oluştururlar. Her hesaba kaydolduğunda belirli bir miktar
                <span class="underline font-bold"> temsili para </span> yatırılır.
                Borsa İstanbul Deneyimi: Kullanıcılar, bu temsili parayı kullanarak
                gerçek zamanlı Borsa İstanbul verileri üzerinden sanal hisse senedi
                alım satımı yapabilirler. Platform, gerçek piyasa koşullarını
                yansıtır, böylece kullanıcılar gerçek zamanlı olarak finansal kararlar
                alabilirler. Analiz ve Öğrenme: Demobist, kullanıcılara borsa ve
                yatırım stratejileri konusunda bilgi edinme fırsatı sunar.
                Kullanıcılar, gerçek piyasa hareketlerini takip ederek farklı
                stratejiler deneyebilir ve finansal okuryazarlıklarını artırabilirler.
                Topluluk Etkileşimi: Platform, kullanıcılar arasında etkileşimi teşvik
                eder. Kullanıcılar, diğer yatırımcılarla fikir alışverişinde
                bulunabilir, stratejilerini tartışabilir ve birbirlerinden
                öğrenebilirler
            </p>
            <a href="#" class="demo-bist-bg demobist-hover ml-5 mr-5 text-white border rounded-md px-16 py-4 flex items-center justify-center text-decoration-none">
                SORU SOR
            </a>
        </div>
        <div class="w-1/2 demobist-bilesen-img flex justify-center">
            <img src="images/demobist-nasil-calisir-borsa-istanbul.webp" alt="" />
        </div>
    </div>

    <div class="demobist-container demo-bist-bg text-center flex text-white  flex-wrap" id="amacimiz">
        <div class="w-1/2">
            <h3 class="text-3xl text-center font-bold">Amacımız</h3>
            <p class="text-left m-6">
                <strong> Demobist'in </strong> temel amacı, kullanıcıların finansal potansiyellerini gerçek dünya
                koşullarında değerlendirmelerine yardımcı olmaktır. Platform, kullanıcıların piyasa
                davranışlarını gözlemleyerek, <strong> risk almadan yatırım yapma ve finansal karar alma </strong>
                becerilerini geliştirmelerine olanak tanır. Böylece, kullanıcılar gerçek yatırım
                dünyasına hazırlıklı bir şekilde adım atmış olurlar.
                Demobist, finansal okuryazarlığın yaygınlaştırılması ve yatırım yapma becerilerinin
                artırılmasına katkıda bulunarak, bireylerin mali geleceklerini güçlendirmeyi
                amaçlar
            </p>
            <a href="#" class="demo-bist-bg demobist-hover  ml-5 mr-5 text-white border rounded-md px-16 py-4 flex items-center justify-center text-decoration-none">
                HEMEN BİZE KATIL
            </a>
        </div>
        <div class="w-1/2 demobist-bilesen-img flex justify-center">
            <img src="images/bistdemo-amacimiz-borsa-istanbul.webp" alt="" />
        </div>
    </div>

    <div class="demobist-container" id="sikca-sorulan-sorular">
        <h3 class="text-3xl text-center font-bold">Sık Sorulan Sorular</h3>
        <?php include("sorular.html"); ?>
    </div>

    <div class="demobist-container demo-bist-bg bg-white text-white" id="iletisim">
        <div>
            <h2 class=" mb-4 text-3xl tracking-tight font-extrabold text-center text-white">İletişim
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Teknik bir
                sorun
                mu var? Bir özellik hakkında geri bildirim mi göndermek istiyorsunuz? İş planımızla ilgili
                ayrıntılara mı ihtiyacınız var?

            </p>
            <form action="#" class="space-y-8 demobist-container">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Email Adresiniz</label>
                    <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="mail@mail.com" required>
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-white">Konu Başlığı</label>
                    <input type="text" id="subject" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Konu Başlığı" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-white">Mesajınız</label>
                    <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="İletiniz"></textarea>
                </div>
                <button type="submit" class="demo-bist-bg w-full demobist-hover text-white border rounded-md px-16 py-4 flex items-center justify-center text-decoration-none">
                    GÖNDER</button>
            </form>
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
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>


</html>