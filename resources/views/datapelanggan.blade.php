<!-- NRP: 5026231150| Nama: Muhammad Dzaki Adfiz -->


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- shared navbar styles (if you have it) --}}
    @if (View::exists('layouts.nav-styles'))
        @include('layouts.nav-styles')
    @endif

    <style>
        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(20px); }
            to { opacity:1; transform:translateY(0); }
        }
        @keyframes slideInLeft {
            from { opacity:0; transform:translateX(-20px); }
            to { opacity:1; transform:translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity:0; transform:translateX(20px); }
            to { opacity:1; transform:translateX(0); }
        }
        @keyframes fadeIn {
            from { opacity:0; }
            to { opacity:1; }
        }
        @keyframes modalSlideIn {
            from { opacity:0; transform:translateY(-20px) scale(.95); }
            to { opacity:1; transform:translateY(0) scale(1); }
        }

        :root {
            --bg-main: #f5f5f5;
            --card-bg: #ffffff;
            --primary: #0d9488;
            --text-main: #111827;
            --text-muted: #6b7280;
            --fab-blue: #14b8a6;
            --accent: #14b8a6;
            --success: #10b981;
            --error: #ef4444;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: "Poppins", sans-serif; background: #f5f5f5; min-height:100vh; }
        .screen { max-width:480px; margin:0 auto; min-height:100vh; display:flex; flex-direction:column; padding-bottom:100px; }
        .page-header { background: linear-gradient(135deg, #f0f4ff, rgba(240,244,255,.8)); padding:20px; text-align:center; margin-bottom:20px; animation: fadeInUp .6s ease-out; border-bottom: 2px solid rgba(79,70,229,.1); }
        .page-header h1 { font-size:26px; font-weight:700; background: linear-gradient(135deg, var(--primary), var(--fab-blue)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .content { padding:0 20px; }
        .section-title{ font-size:16px; font-weight:600; color:#555; margin-bottom:15px; animation: fadeInUp .6s ease-out .1s both; }
        .profile-card{ background: linear-gradient(135deg, var(--card-bg), rgba(255,255,255,.95)); border-radius:12px; padding:20px; margin-bottom:15px; box-shadow: 0 4px 12px rgba(13, 148, 136, .1); animation: fadeInUp .5s ease-out backwards; border: 1px solid rgba(13, 148, 136, .08); transition: all .3s ease; }
        .profile-card.inactive { background: linear-gradient(135deg, #f3f4f6, #e5e7eb); border-color: #d1d5db; opacity: 0.7; }
        .profile-card.inactive .profile-name { color: #9ca3af; }
        .profile-card.inactive .profile-address,
        .profile-card.inactive .profile-phone { color: #9ca3af; }
        .profile-card.inactive .avatar { background: linear-gradient(135deg, #9ca3af, #6b7280); }
        .profile-card.inactive .action-btn { color: #9ca3af; }
        .profile-card.inactive:hover { box-shadow: 0 6px 16px rgba(0,0,0,.08); transform:translateY(-2px); border-color: #d1d5db; }
        .profile-card:nth-child(1){ animation-delay:.05s; }
        .profile-card:nth-child(2){ animation-delay:.1s; }
        .profile-card:nth-child(3){ animation-delay:.15s; }
        .profile-card:nth-child(4){ animation-delay:.2s; }
        .profile-card:hover{ box-shadow: 0 8px 20px rgba(13, 148, 136, .15); transform:translateY(-3px); border-color: rgba(13, 148, 136, .2); }
        .profile-header{ display:flex; gap:15px; margin-bottom:12px; }
        .avatar{ width:45px; height:45px; background: linear-gradient(135deg, var(--primary), var(--fab-blue)); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-weight:600; font-size:20px; }
        .profile-info{ flex:1; }
        .profile-name{ font-size:16px; font-weight:600; color:#1a1a1a; }
        .profile-address, .profile-phone{ font-size:13px; color:#666; margin-top:4px; }
        .profile-actions{ display:flex; gap:20px; padding-left:60px; }
        .action-btn{ font-size:14px; font-weight:600; color: var(--fab-blue); background:none; border:none; cursor:pointer; transition: all .3s ease; position:relative; text-decoration:none; display:inline-block; }
        .action-btn:hover{ color: var(--primary); }
        .action-btn::after{ content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background: linear-gradient(135deg, var(--primary), var(--fab-blue)); transition: width .3s ease; }
        .action-btn:hover::after{ width:100%; }
        .add-profile-btn{ background: linear-gradient(135deg, var(--primary), var(--fab-blue)); color:white; border:none; border-radius:12px; padding:16px; font-size:16px; font-weight:600; width:calc(100% - 40px); margin:20px; cursor:pointer; box-shadow: 0 6px 16px rgba(13, 148, 136, .25); animation: fadeInUp .6s ease-out .3s both; transition: all .3s ease; }
        .add-profile-btn:hover{ box-shadow: 0 10px 24px rgba(13, 148, 136, .35); transform:translateY(-2px); }
        .add-profile-btn:active{ transform:translateY(0); }
        .form-header { background: #f9f9f9; padding:20px; text-align:center; margin-bottom:20px; position:relative; border-bottom: 2px solid rgba(13, 148, 136, .1); }
        .form-header h1 { font-size:24px; font-weight:700; background: linear-gradient(135deg, var(--primary), var(--fab-blue)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .back-button { position:absolute; left:20px; top:50%; transform:translateY(-50%); font-size:28px; border:none; background:none; cursor:pointer; color: var(--primary); transition: all .3s ease; }
        .back-button:hover { transform:translateY(-50%) scale(1.1); }
        .form-container { padding:0 20px; }
        .form-card{ background: linear-gradient(135deg, white, rgba(255,255,255,.95)); border-radius:16px; padding:30px 20px; box-shadow: 0 8px 24px rgba(13, 148, 136, .12); border: 1px solid rgba(13, 148, 136, .08); }
        .form-group{ margin-bottom:20px; animation: fadeInUp .6s ease-out backwards; }
        .form-group:nth-child(1){ animation-delay:.1s; }
        .form-group:nth-child(2){ animation-delay:.15s; }
        .form-group:nth-child(3){ animation-delay:.2s; }
        .form-group:nth-child(4){ animation-delay:.25s; }
        .form-group:nth-child(5){ animation-delay:.3s; }
        .form-label{ font-weight:600; margin-bottom:8px; display:block; color: var(--primary); font-size:14px; }
        .form-input{ width:100%; padding:12px 0; border:none; border-bottom:2px solid #e5e7eb; font-size:14px; background:transparent; outline:none; transition: all .3s ease; font-family: "Poppins", sans-serif; }
        .form-input:hover{ border-bottom-color: #0d9488; }
        .form-input:focus{ border-bottom-color: var(--fab-blue); box-shadow: 0 2px 0 rgba(79,70,229,.2); }
        .error-text { color: var(--error); font-size:12px; margin-top:5px; }
        .submit-btn{ background: linear-gradient(135deg, var(--primary), var(--fab-blue)); color:white; border:none; border-radius:12px; padding:16px; font-size:16px; font-weight:600; width:100%; cursor:pointer; margin-top:20px; box-shadow: 0 6px 16px rgba(79,70,229,.25); transition: all .3s ease; animation: fadeInUp .6s ease-out .35s both; }
        .submit-btn:hover{ box-shadow: 0 10px 24px rgba(79,70,229,.35); transform:translateY(-2px); }
        .submit-btn:active{ transform:translateY(0); }
        .alert { padding:10px 14px; border-radius:8px; margin: 12px 20px; animation: fadeInUp .4s ease-out; border-left: 4px solid; }
        .alert-success { background: linear-gradient(135deg, rgba(16,185,129,.08), rgba(16,185,129,.04)); color:#065f46; border-left-color:#10b981; }
        .alert-error { background: linear-gradient(135deg, rgba(239,68,68,.08), rgba(239,68,68,.04)); color:#7f1d1d; border-left-color:#ef4444; }

        /* Modal Styles */
        .modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.5); display:none; align-items:center; justify-content:center; z-index:9999; animation: fadeIn .3s ease-out; }
        .modal-overlay.active { display:flex; }
        .modal-content { background:white; border-radius:20px; padding:0; max-width:400px; width:90%; box-shadow: 0 20px 60px rgba(79,70,229,.25); animation: modalSlideIn .4s ease-out; overflow:hidden; border: 2px solid rgba(79,70,229,.1); }
        .modal-header { background: linear-gradient(135deg, #f0f4ff, rgba(240,244,255,.8)); padding:20px; display:flex; justify-content:space-between; align-items:center; border-bottom: 2px solid rgba(79,70,229,.1); }
        .modal-title { font-size:20px; font-weight:700; background: linear-gradient(135deg, var(--primary), var(--fab-blue)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .modal-close { background:none; border:none; font-size:28px; cursor:pointer; color:var(--text-muted); transition: all .3s ease; line-height:1; }
        .modal-close:hover { color:var(--primary); transform:scale(1.1); }
        .modal-body { padding:30px 25px; text-align:center; }
        .modal-body p { font-size:15px; color:var(--text-main); line-height:1.6; margin-bottom:10px; }
        .modal-body .customer-name { font-weight:700; color:var(--primary); font-size:16px; }
        .modal-actions { display:flex; gap:12px; padding:20px 25px; border-top:1px solid rgba(79,70,229,.08); flex-direction:row-reverse; }
        .modal-btn { flex:1; padding:14px; border:none; border-radius:12px; font-size:15px; font-weight:600; cursor:pointer; transition: all .3s ease; font-family: "Poppins", sans-serif; width:100%; }
        .modal-btn-cancel { background:linear-gradient(135deg, #e5e7eb, #f3f4f6); color:#374151; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .modal-btn-cancel:hover { background:linear-gradient(135deg, #d1d5db, #e5e7eb); transform:translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,.12); }
        .modal-btn-confirm { background:linear-gradient(135deg, #ef4444, #dc2626); color:white; box-shadow: 0 4px 12px rgba(239,68,68,.3); }
        .modal-btn-confirm:hover { background:linear-gradient(135deg, #dc2626, #b91c1c); transform:translateY(-1px); box-shadow: 0 6px 16px rgba(239,68,68,.4); }
        .modal-btn-activate { background:linear-gradient(135deg, #10b981, #059669); color:white; box-shadow: 0 4px 12px rgba(16,185,129,.3); }
        .modal-btn-activate:hover { background:linear-gradient(135deg, #059669, #047857); transform:translateY(-1px); box-shadow: 0 6px 16px rgba(16,185,129,.4); }
        .modal-form { flex:1; margin:0; }
    </style>
</head>
<body>
    <div class="screen">

        {{-- flash messages --}}
        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
        </div>

        {{-- LIST --}}
        <div id="listPage" class="page active" style="display:{{ isset($editData) ? 'none' : 'block' }}">
            <div class="page-header">
                <h1>Data Pelanggan</h1>
            </div>

            <div class="content">
                <div class="section-title">Profil Tersimpan</div>

                @if (isset($pelanggan) && count($pelanggan) > 0)
                    @foreach ($pelanggan as $data)
                        <div class="profile-card {{ isset($data->aktif) && !$data->aktif ? 'inactive' : '' }}">
                            <div class="profile-header">
                                <div class="avatar"><i class="bi bi-person"></i></div>
                                <div class="profile-info">
                                    <div class="profile-name">{{ $data->Nama }}</div>
                                    <div class="profile-address">{{ $data->Alamat }}</div>
                                    <div class="profile-phone">Telepon: {{ $data->Nomor_HP }}</div>
                                </div>
                            </div>

                            <div class="profile-actions">
                                <a href="{{ route('pelanggan.edit', $data->IDPelanggan) }}" class="action-btn">Ubah</a>
                                <button class="action-btn" onclick="showStatusModal({{ $data->IDPelanggan }}, '{{ $data->Nama }}', {{ isset($data->aktif) && $data->aktif ? 'true' : 'false' }})">
                                    {{ isset($data->aktif) && $data->aktif ? 'Non-Aktif' : 'Aktifkan' }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="avatar"><i class="bi bi-person"></i></div>
                            <div class="profile-info">
                                <div class="profile-name">Contoh</div>
                                <div class="profile-address">Alamat contoh</div>
                                <div class="profile-phone">Telepon: 08xxxx</div>
                            </div>
                        </div>
                    </div>
                @endif

                <button class="add-profile-btn" onclick="showAddProfile()">Tambah Profil</button>
            </div>
        </div>

        {{-- FORM --}}
        <div id="formPage" class="page" style="display:{{ isset($editData) ? 'block' : 'none' }}">
            <div class="form-header">
                <button class="back-button" onclick="showList()">‹</button>
                <h1>{{ isset($editData) ? 'Ubah Profil' : 'Tambah Profil' }}</h1>
            </div>

            <div class="form-container">
                 <div class="form-card">
                     @if(isset($editData))
                         <form method="POST" action="{{ route('pelanggan.update', $editData->IDPelanggan) }}">
                             @method('PUT')
                     @else
                         <form method="POST" action="{{ route('pelanggan.store') }}">
                     @endif
                         @csrf

                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input type="text" name="Nama" class="form-input"
                                placeholder="Masukkan nama lengkap"
                                value="{{ old('Nama', isset($editData) ? $editData->Nama : '') }}" required>
                            @error('Nama') <div class="error-text">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="Email" class="form-input"
                                placeholder="Gunakan email aktif"
                                value="{{ old('Email', isset($editData) ? $editData->Email : '') }}" required>
                            @error('Email') <div class="error-text">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" name="Nomor_HP" class="form-input"
                                placeholder="08xxxxxxxxxx"
                                value="{{ old('Nomor_HP', isset($editData) ? $editData->Nomor_HP : '') }}" required>
                            @error('Nomor_HP') <div class="error-text">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group" style="margin-bottom:24px;">
                            <label class="form-label" style="font-weight:600;color:#0d9488;">
                                Tanggal Lahir
                            </label>

                        <div style="
                            position:relative;
                            display:flex;
                            align-items:center;
                            border-bottom:2px solid #e5e7eb;
                            padding-bottom:6px;
                        ">
                            <input
                                type="date"
                                name="Tanggal_Lahir"
                                value="{{ old(
                                    'Tanggal_Lahir',
                                    isset($editData)
                                        ? \Carbon\Carbon::parse($editData->Tanggal_Lahir)->format('Y-m-d')
                                        : ''
                                ) }}"
                                max="{{ date('Y-m-d') }}"
                                required
                                style="
                                    flex:1;
                                    border:none;
                                    outline:none;
                                    font-size:14px;
                                    padding:10px 0;
                                    background:transparent;
                                    color:#111827;
                                    appearance:none;
                                    -webkit-appearance:none;
                                "
                                onfocus="this.parentElement.style.borderBottomColor='#14b8a6'"
                                onblur="this.parentElement.style.borderBottomColor='#e5e7eb'"
                            >


                    </div>

                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="Alamat" class="form-input"
                                placeholder="Masukkan alamat lengkap"
                                value="{{ old('Alamat', isset($editData) ? $editData->Alamat : '') }}" required>
                            @error('Alamat') <div class="error-text">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="submit-btn">
                            {{ isset($editData) ? 'Perbarui Profil' : 'Tambah Profil' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>


        {{-- shared navbar if present --}}
        @if (View::exists('layouts.navbar'))
            @include('layouts.navbar')
        @endif

        {{-- Status Modal --}}
        <div id="statusModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="modalTitle">NON-AKTIF ITEM</div>
                    <button class="modal-close" onclick="closeStatusModal()">×</button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk <span id="modalAction">non-aktifkan</span></p>
                    <p class="customer-name" id="modalCustomerName">pelanggan ini</p>
                </div>
                <div class="modal-actions">
                    <form id="statusForm" method="POST" class="modal-form">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="modal-btn modal-btn-confirm" id="confirmBtn">Non-aktif</button>
                    </form>
                    <button class="modal-btn modal-btn-cancel" onclick="closeStatusModal()">Batalkan</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        function showAddProfile() {
            document.getElementById('listPage').style.display = 'none';
            document.getElementById('formPage').style.display = 'block';

            // Update form header
            document.querySelector('.form-header h1').textContent = 'Tambah Profil';

            // Reset form
            document.querySelector('#formPage form').reset();

            // Change form action to store route (if needed)
            const form = document.querySelector('#formPage form');
            form.action = "{{ route('pelanggan.store') }}";

            // Remove PUT method if exists
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }

            // Update button text
            document.querySelector('.submit-btn').textContent = 'Tambah Profil';
        }

        function showList() {
            document.getElementById('formPage').style.display = 'none';
            document.getElementById('listPage').style.display = 'block';

            // Redirect to index to clear edit state
            window.location.href = "{{ route('pelanggan.index') }}";
        }

        // Modal functions
        function showStatusModal(id, name, isActive) {
            const modal = document.getElementById('statusModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalAction = document.getElementById('modalAction');
            const modalCustomerName = document.getElementById('modalCustomerName');
            const confirmBtn = document.getElementById('confirmBtn');
            const statusForm = document.getElementById('statusForm');

            if (isActive) {
                // Non-aktifkan
                modalTitle.textContent = 'NON-AKTIF ITEM';
                modalAction.textContent = 'non-aktifkan';
                confirmBtn.textContent = 'Non-aktif';
                confirmBtn.className = 'modal-btn modal-btn-confirm';
            } else {
                // Aktifkan
                modalTitle.textContent = 'AKTIFKAN ITEM';
                modalAction.textContent = 'aktifkan';
                confirmBtn.textContent = 'Aktifkan';
                confirmBtn.className = 'modal-btn modal-btn-activate';
            }

            modalCustomerName.textContent = name;

            // Set form action - you need to create this route
            statusForm.action = `/pelanggan/${id}/toggle-status`;

            modal.classList.add('active');
        }

        function closeStatusModal() {
            const modal = document.getElementById('statusModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('statusModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });

        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        });
    </script>
</body>
</html>
