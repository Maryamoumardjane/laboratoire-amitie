

<section class="labo-contact-section" id="contact">
    <div class="container">
        <div class="labo-contact-inner">

            {{-- COLONNE GAUCHE --}}
            <div class="labo-contact-left">

                <div class="labo-contact-pill"><span></span>Disponible 24h/7j</div>
                <h2>Parlons de<br><em>votre santé</em></h2>
                <p>Notre équipe est là pour vous accompagner, répondre à vos questions et planifier vos examens.</p>

                <div class="labo-info-list">

                    <div class="labo-info-row">
                        <div class="labo-info-dot">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="#0a5c3f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 2h2.5l1 3.5L5 7s1 2 4 4l1.5-1.5L14 10.5V13a1 1 0 01-1 1C5 14 2 7 2 3a1 1 0 011-1z"/>
                            </svg>
                        </div>
                        <div class="labo-info-txt">
                            <label>Téléphone</label>
                            <span>+237 675858239</span>
                        </div>
                    </div>

                    <div class="labo-info-row">
                        <div class="labo-info-dot">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="#0a5c3f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 2h2.5l1 3.5L5 7s1 2 4 4l1.5-1.5L14 10.5V13a1 1 0 011-1z"/>
                                <path d="M10.5 1.5a4 4 0 010 5.5" stroke-dasharray="1.5 1"/>
                            </svg>
                        </div>
                        <div class="labo-info-txt">
                            <label>WhatsApp</label>
                            <span>+237 675858239</span>
                        </div>
                    </div>

                    <div class="labo-info-row">
                        <div class="labo-info-dot">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="#0a5c3f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="12" height="9" rx="1.5"/>
                                <path d="M2 4l6 5 6-5"/>
                            </svg>
                        </div>
                        <div class="labo-info-txt">
                            <label>Email</label>
                            <span>laboratoiredelamitie4@email.com</span>
                        </div>
                    </div>

                    <div class="labo-hours-badge">
                        <span class="labo-pulse"></span>
                        <span>Ouvert maintenant · Lundi – Dimanche, 24h/24</span>
                    </div>

                </div>

                <div class="labo-map-strip">
                    <div class="labo-map-icon">
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="#0a5c3f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 1.5C5.5 1.5 3.5 3.5 3.5 6c0 3.5 4.5 8.5 4.5 8.5s4.5-5 4.5-8.5c0-2.5-2-4.5-4.5-4.5z"/>
                            <circle cx="8" cy="6" r="1.5"/>
                        </svg>
                    </div>
                    <div class="labo-map-txt">
                        <p>Yaoundé, Cameroun</p>
                        <span>Centre-ville · Accès facile</span>
                    </div>
                    <a class="labo-map-link" href="https://maps.google.com" target="_blank">
                        Voir
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 8L8 2M4 2h4v4"/>
                        </svg>
                    </a>
                </div>

            </div>

            {{-- COLONNE DROITE --}}
            <div class="labo-contact-right">

                <div class="labo-form-card">

                    <div class="labo-form-top">
                        <div class="labo-form-top-icon">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="#0a5c3f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h12v8a1 1 0 01-1 1H3a1 1 0 01-1-1V3z"/>
                                <path d="M2 3l6 5 6-5"/>
                            </svg>
                        </div>
                        <div class="labo-form-top-text">
                            <h3>Envoyer un message</h3>
                            <p>Réponse sous 24h garantie</p>
                        </div>
                    </div>

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <div class="labo-form-body">

                            <div class="labo-row2">
                                <div class="labo-fld">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" id="prenom" name="prenom" placeholder="maryam">
                                </div>
                                <div class="labo-fld">
                                    <label for="nom">Nom</label>
                                    <input type="text" id="nom" name="nom" placeholder="haroun">
                                </div>
                            </div>

                            <div class="labo-fld">
                                <label for="telephone">Téléphone / WhatsApp</label>
                                <input type="text" id="telephone" name="telephone" placeholder="+237 6XX XXX XXX">
                            </div>

                            <div class="labo-fld">
                                <label for="objet">Objet</label>
                                <select id="objet" name="objet">
                                    <option value="">Choisir un sujet...</option>
                                    <option value="rdv">Demande de rendez-vous</option>
                                    <option value="resultats">Résultats d'examen</option>
                                    <option value="domicile">Prélèvement à domicile</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>

                            <div class="labo-fld">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="4" placeholder="Décrivez votre demande..."></textarea>
                            </div>

                        </div>

                        <div class="labo-form-footer">
                            <div class="labo-footer-note">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="5" width="10" height="6" rx="1"/>
                                    <path d="M3 5V3.5a3 3 0 016 0V5"/>
                                </svg>
                                Données confidentielles
                            </div>
                            <button type="submit" class="labo-btn-send">
                                <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 8h12M9 3l5 5-5 5"/>
                                </svg>
                                Envoyer
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
        @if(session('success'))
    <div class="alert alert-success rounded-3 mb-3">
        {{ session('success') }}
    </div>
@endif
    </div>
</section>