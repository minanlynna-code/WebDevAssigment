@extends('layouts.app')

@section('content')

<section class="bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-3 fw-bold">Fresh Coffee Everyday</h1>
        <p class="lead">Order online and skip the queue.</p>
    </div>
</section>

<div class="container py-4">
    <h4 class="fw-bold mb-3">       </h4>

    <div class="row g-3">
        <div class="col-md-6">
            <a href="/menu" class="order-card-btn">
                <span>PICKUP</span>
                <span class="order-emoji">🥤</span>
            </a>
        </div>
        <div class="col-md-6">
            <button type="button" class="order-card-btn w-100" onclick="openModal()">
                <span>DELIVERY</span>
                <span class="order-emoji">🛍️</span>
            </button>
        </div>
    </div>
</div>

{{-- White Pop-Up Message in Center --}}
<div id="comingSoonModal" class="custom-modal-overlay">
    <div class="custom-modal-box">
        <h3>Coming Soon!</h3>
        <p>Delivery service is currently under development. Stay tuned!</p>
        <button type="button" class="btn-modal-close" onclick="closeModal()">Got it</button>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('comingSoonModal').classList.add('show');
    }

    function closeModal() {
        document.getElementById('comingSoonModal').classList.remove('show');
    }

    window.onclick = function(event) {
        const modal = document.getElementById('comingSoonModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

@endsection