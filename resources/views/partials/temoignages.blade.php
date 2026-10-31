@php
    $temoignages = \App\Models\Temoignage::where('approuve', true)->latest()->take(6)->get();
@endphp

<section class="temoignages-section py-5" id="temoignages">
    <div class="container">

        <!-- TITRE -->
        <div class="text-center mb-5">
            <h2 style="color:#1a2e5a; font-weight:700;">⭐ Avis de nos Patients</h2>
            <p class="text-muted">Ce que disent nos patients sur nos services</p>
            <div style="width:60px; height:4px; background:linear-gradient(90deg,#2e7d32,#e65100); margin:0 auto; border-radius:2px;"></div>
        </div>

        <!-- TÉMOIGNAGES -->
        @if($temoignages->count() > 0)
        <div class="row g-4 mb-5">
            @foreach($temoignages as $t)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4"
                     style="border-radius:16px; border-top:4px solid #2e7d32 !important;">

                    <!-- ÉTOILES -->
                    <div class="mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $t->etoiles)
                                <span style="color:#f4c430; font-size:20px;">★</span>
                            @else
                                <span style="color:#ddd; font-size:20px;">★</span>
                            @endif
                        @endfor
                    </div>

                    <!-- MESSAGE -->
                    <p style="color:#555; font-style:italic; line-height:1.7; flex-grow:1;">
                        "{{ $t->message }}"
                    </p>

                    <!-- NOM -->
                    <div class="d-flex align-items-center mt-3">
                        <div style="width:42px; height:42px; border-radius:50%;
                                    background:linear-gradient(135deg,#1a2e5a,#2e7d32);
                                    display:flex; align-items:center; justify-content:center;
                                    color:white; font-weight:700; font-size:16px; margin-right:12px;">
                            {{ strtoupper(substr($t->nom, 0, 1)) }}
                        </div>
                        <div>
                            <strong style="color:#1a2e5a;">{{ $t->nom }}</strong>
                            <br>
                            <small style="color:#aaa;">
                                {{ $t->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- FORMULAIRE AVIS -->
        <div class="card border-0 shadow p-5"
             style="border-radius:20px; background:linear-gradient(135deg,#f8f9fc,#eef1f7); max-width:600px; margin:0 auto;">

            <h4 class="text-center mb-4" style="color:#1a2e5a;">
                💬 Donnez votre avis
            </h4>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('temoignages.store') }}">
                @csrf

                <!-- NOM -->
                <div class="mb-3">
                    <label class="form-label fw-bold">👤 Votre nom</label>
                    <input type="text" name="nom" class="form-control"
                           placeholder="Ex: Maryam" required>
                </div>

                <!-- EMAIL -->
                <div class="mb-3">
                    <label class="form-label fw-bold">📧 Email (optionnel)</label>
                    <input type="email" name="email" class="form-control"
                           placeholder="exemple@gmail.com">
                </div>

                <!-- ÉTOILES -->
                <div class="mb-3">
                    <label class="form-label fw-bold">⭐ Note</label>
                    <div class="star-rating">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="etoiles"
                                   id="star{{ $i }}" value="{{ $i }}"
                                   {{ $i == 5 ? 'checked' : '' }}>
                            <label for="star{{ $i }}" title="{{ $i }} étoiles">★</label>
                        @endfor
                    </div>
                </div>

                <!-- MESSAGE -->
                <div class="mb-4">
                    <label class="form-label fw-bold">💬 Votre avis</label>
                    <textarea name="message" class="form-control" rows="4"
                              placeholder="Partagez votre expérience avec le Laboratoire de l'Amitié..."
                              maxlength="500" required></textarea>
                </div>

                <button type="submit" class="btn w-100 py-3"
                        style="background:linear-gradient(135deg,#1a2e5a,#2e7d32); color:white; border-radius:30px; font-weight:600; font-size:16px;">
                    📤 Envoyer mon avis
                </button>

            </form>
        </div>

    </div>
</section>

<style>
/* ===== ÉTOILES INTERACTIVES ===== */
.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: 4px;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 36px;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
}

.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #f4c430;
}
</style>