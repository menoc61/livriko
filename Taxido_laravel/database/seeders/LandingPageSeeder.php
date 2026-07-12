<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $content = [
            "en" => [
                "header" => [
                    "logo" => "/front/images/placeholder/142x36.png",
                    "menus" => [
                        'home',
                        'why_taxi_booking',
                        'how_it_works',
                        'faqs',
                        'blogs',
                        'testimonials',
                        'raise_tickets'
                    ],
                    "status" => "1",
                    "btn_url" => "#app",
                    "btn_text" => 'Book Ride',
                ],
                "home" => [
                    "title" => "Ride with Comfort, Drive with Confidence",
                    "description" => "Where comfort meets confidence—ride with ease, drive with pride, and let us handle the rest, ensuring every journey is safe, reliable, and truly unforgettable.",
                    "button" => [
                        [
                            "text" => "User App",
                            "type" => "gradient",
                            "url" => "https://play.google.com/store",
                        ],
                        [
                            "text" => "Driver App",
                            "type" => "outline",
                            "url" => "https://play.google.com/store"
                        ]
                    ],
                    "right_phone_image" => "/front/images/placeholder/1.png",
                    "left_phone_image" => '/front/images/placeholder/2.png',
                    "bg_image" => '',
                    "status" => "1",
                ],
                "statistics" => [
                    "status" => "1",
                    "title" => "Driving Success Together",
                    "description" => "From countless completed rides to a thriving network of users and drivers, our journey is defined by excellence and customer satisfaction.",
                    "counters" => [
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Completed Rides",
                            "description" => "Delivering trusted rides for countless happy Riders daily.",
                            "count" => "100000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Active Users",
                            "description" => "Connecting with thousands who trust us for reliable rides.",
                            "count" => "50000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Active Drivers",
                            "description" => "Dedicated drivers ensuring safe, timely, and comfortable rides.",
                            "count" => "30000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Customer Rating",
                            "description" => "Positive ratings that reflect trust and service excellence.",
                            "count" => "4.9",
                        ]
                    ]
                ],
                "feature" => [
                    "status" => "1",
                    "title" => "Why Taxido Stands Out as Your Go-To Ride Option",
                    "description" => "With Taxido, enjoy affordable rates, safe journeys, and a user-friendly platform that makes travel easier and more enjoyable than ever before.",
                    "images" => [
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Track Your Driver Live",
                            "description" => "Stay updated on your driver’s location every moment."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Flexible Vehicle Rentals",
                            "description" => "Choose and rent vehicles tailored to your specific needs."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Bidding Simplified",
                            "description" => "Accept or reject bids effortlessly for complete booking control."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Convenient Hourly Packages",
                            "description" => "Access services in your preferred language without barriers."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Language Options for Everyone",
                            "description" => "Access services in your preferred language without barriers."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Secure Payment Choices",
                            "description" => "Multiple secure payment options to fit your preference."
                        ],
                    ]
                ],
                "ride" => [
                    "status" => "1",
                    "title" => "How Taxido Makes Your Ride Easy",
                    "description" => "Get started in just a few simple steps. Choose your ride, track your driver, and enjoy a smooth, hassle-free journey with Taxido..",
                    "step" => [
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Sign Up",
                            "description" => "Create your account in minutes by entering your details—quick and easy!"
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Set Your Pickup Location",
                            "description" => "Choose where you’d like to be picked up and let us handle the rest."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Find Your Driver",
                            "description" => "Get paired with a nearby driver and track their location in real-time.."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Complete Your Payment",
                            "description" => "Pay securely using your preferred payment option through our multi-gateway support."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Rate Your Ride",
                            "description" => "Rate your ride and help us improve for even better experiences ahead."
                        ]
                    ]
                ],
                "faq" => [
                    "title" => "Frequently Asked Questions",
                    "sub_title" => "Got questions? Explore our FAQs for quick answers about Taxido's features, services, and app usage. Booking a ride, scheduling, or exploring services? Find all the answers here.",
                    "faqs" => [],
                    "status" => "1",
                ],
                "blog" => [
                    "title" => "Stay Updated with Taxido",
                    "sub_title" => "Be the first to know about exciting offers, latest updates, and helpful travel tips from Taxido. Stay informed and make the most out of your rides with insights and announcements tailored just for you.",
                    "blogs" => [],
                    "status" => "1",
                ],
                "testimonial" => [
                    "title" => "What Our Users Say",
                    "sub_title" => "Real stories from our satisfied users. Taxido is transforming the way people commute, providing safe, reliable, and convenient rides.",
                    "testimonials" => [],
                    "status" => "1",
                ],
                "footer" => [
                    "footer_logo" => "front/images/placeholder/197x50.png",
                    "description" => "Get started in minutes—choose your ride, track your driver, and enjoy a hassle-free journey with Taxido!",
                    "newsletter" => [
                        "label" => "Subscribe our Newsletter",
                        "placeholder" => "Enter email address",
                        "button_text" => "Subscribe"
                    ],
                    'play_store_url' => "#!",
                    "app_store_url" => "#!",
                    "social_links" => [
                        "facebook"  => "https://www.facebook.com",
                        "google"    => "https://www.google.com",
                        "instagram" => "https://www.instagram.com",
                        "twitter-x"   => "https://twitter.com",
                        "whatsapp"  => "https://wa.me/your-number",
                        "linkedin" => "https: //linkedin.com",
                    ],
                    "pages" => [],
                    "right_image" => "front/images/placeholder/638x528.png",
                    "copyright" => "© Taxido All Rights & Reserves -",
                    "status" => "1",
                ],
                "seo" => [
                    "status" => "1",
                    "og_title" => "Taxido - The Future of Convenient Transportation",
                    "meta_tags" => "taxido, ride-hailing, taxi service, transportation, car service, book a ride, city transport, ride sharing, reliable taxi, on-demand rides.",
                    "meta_image" => "/front/images/logo.svg",
                    "meta_title" => "Taxido - Your Reliable Ride-Hailing Partner",
                    "og_description" => "Discover Taxido, your ultimate ride-hailing solution. Enjoy fast, safe, and reliable transportation at your fingertips. Download our app today for a seamless travel experience.",
                    "meta_description" => "Experience seamless and convenient transportation with Taxido. Book your ride easily and get to your destination safely with our reliable and efficient ride-hailing service."
                ],
                "analytics" => [
                    "status" => "1",
                    "pixel_id" => "XXXXXXXXXXXXX",
                    "pixel_status" => "1",
                    "measurement_id" => "UA-XXXXXX-XX",
                    "tag_id" => "XXXXXXXXXXXXX",
                    "chat_bot_id" => "XXXXXXXXXXX"
                ],
            ],
            "fr" => [
                "header" => [
                    "logo" => "/front/images/placeholder/142x36.png",
                    "menus" => [
                        'home',
                        'why_taxi_booking',
                        'how_it_works',
                        'faqs',
                        'blogs',
                        'testimonials',
                        'raise_tickets'
                    ],
                    "status" => "1",
                    "btn_url" => "#app",
                    "btn_text" => 'Réserver une course',
                ],
                "home" => [
                    "title" => "Conduisez avec confiance, voyagez avec confort",
                    "description" => "Là où le confort rencontre la confiance—voyagez en toute simplicité, conduisez avec fierté, et laissez-nous nous occuper du reste, en veillant à ce que chaque voyage soit sûr, fiable et vraiment inoubliable.",
                    "button" => [
                        [
                            "text" => "Application Utilisateur",
                            "type" => "gradient",
                            "url" => "https://play.google.com/store",
                        ],
                        [
                            "text" => "Application Conducteur",
                            "type" => "outline",
                            "url" => "https://play.google.com/store",
                        ]
                    ],
                    "right_phone_image" => "/front/images/placeholder/1.png",
                    "left_phone_image" => '/front/images/placeholder/2.png',
                    "bg_image" => '',
                    "status" => "1",
                ],
                "statistics" => [
                    "status" => "1",
                    "title" => "Conduire le succès ensemble",
                    "description" => "De nombreux trajets effectués à un réseau florissant d'utilisateurs et de conducteurs, notre voyage est défini par l'excellence et la satisfaction client.",
                    "counters" => [
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Trajets effectués",
                            "description" => "Offrir des trajets de confiance à d'innombrables passagers heureux quotidiennement.",
                            "count" => "100000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Utilisateurs actifs",
                            "description" => "Connecter des milliers de personnes qui nous font confiance pour des trajets fiables.",
                            "count" => "50000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Conducteurs actifs",
                            "description" => "Des conducteurs dévoués assurant des trajets sûrs, ponctuels et confortables.",
                            "count" => "30000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Évaluation des clients",
                            "description" => "Des évaluations positives qui reflètent la confiance et l'excellence du service.",
                            "count" => "4.9",
                        ]
                    ]
                ],
                "feature" => [
                    "status" => "1",
                    "title" => "Pourquoi Taxido se distingue comme votre option de trajet préférée",
                    "description" => "Avec Taxido, profitez de tarifs abordables, de voyages sûrs et d'une plateforme conviviale qui rend les déplacements plus faciles et plus agréables que jamais.",
                    "images" => [
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Suivez votre conducteur en direct",
                            "description" => "Restez informé de la localisation de votre conducteur à tout moment."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Location de véhicules flexible",
                            "description" => "Choisissez et louez des véhicules adaptés à vos besoins spécifiques."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Enchères simplifiées",
                            "description" => "Acceptez ou refusez les offres sans effort pour un contrôle total de votre réservation."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Forfaits horaires pratiques",
                            "description" => "Accédez aux services dans votre langue préférée sans barrières."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Options de langue pour tous",
                            "description" => "Accédez aux services dans votre langue préférée sans barrières."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Choix de paiement sécurisés",
                            "description" => "Plusieurs options de paiement sécurisées pour répondre à vos préférences."
                        ],
                    ]
                ],
                "ride" => [
                    "status" => "1",
                    "title" => "Comment Taxido facilite votre trajet",
                    "description" => "Commencez en quelques étapes simples. Choisissez votre trajet, suivez votre conducteur et profitez d'un voyage fluide et sans tracas avec Taxido.",
                    "step" => [
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Inscrivez-vous",
                            "description" => "Créez votre compte en quelques minutes en entrant vos informations—rapide et facile!"
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Définissez votre lieu de prise en charge",
                            "description" => "Choisissez l'endroit où vous souhaitez être pris en charge et laissez-nous nous occuper du reste."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Trouvez votre conducteur",
                            "description" => "Soyez jumelé à un conducteur à proximité et suivez sa localisation en temps réel."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Finalisez votre paiement",
                            "description" => "Payez en toute sécurité en utilisant votre option de paiement préférée grâce à notre support multi-passerelles."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Évaluez votre trajet",
                            "description" => "Évaluez votre trajet et aidez-nous à nous améliorer pour des expériences encore meilleures à l'avenir."
                        ]
                    ]
                ],
                "faq" => [
                    "title" => "Foire aux questions",
                    "sub_title" => "Des questions? Explorez notre FAQ pour des réponses rapides sur les fonctionnalités, services et utilisation de l'application Taxido. Réserver un trajet, planifier ou explorer des services? Trouvez toutes les réponses ici.",
                    "faqs" => [],
                    "status" => "1",
                ],
                "blog" => [
                    "title" => "Restez informé avec Taxido",
                    "sub_title" => "Soyez le premier à connaître les offres passionnantes, les dernières mises à jour et les conseils de voyage utiles de Taxido. Restez informé et profitez au maximum de vos trajets avec des informations et des annonces adaptées spécialement pour vous.",
                    "blogs" => [],
                    "status" => "1",
                ],
                "testimonial" => [
                    "title" => "Ce que disent nos utilisateurs",
                    "sub_title" => "Des histoires réelles de nos utilisateurs satisfaits. Taxido transforme la façon dont les gens se déplacent, en offrant des trajets sûrs, fiables et pratiques.",
                    "testimonials" => [],
                    "status" => "1",
                ],
                "footer" => [
                    "footer_logo" => "front/images/placeholder/197x50.png",
                    "description" => "Commencez en quelques minutes—choisissez votre trajet, suivez votre conducteur et profitez d'un voyage sans tracas avec Taxido!",
                    "newsletter" => [
                        "label" => "Abonnez-vous à notre newsletter",
                        "placeholder" => "Entrez votre adresse e-mail",
                        "button_text" => "S'abonner"
                    ],
                    'play_store_url' => "#!",
                    "app_store_url" => "#!",
                    "quick_links" => [
                        'Accueil',
                        'Pourquoi Taxido?',
                        'Comment ça marche',
                        'FAQs',
                        'Blogs',
                        'Témoignages',
                    ],
                    "pages" => [],
                    "right_image" => "front/images/placeholder/638x528.png",
                    "copyright" => "© Taxido Tous droits réservés -",
                    "status" => "1",
                ],
                "seo" => [
                    "status" => "1",
                    "og_title" => "Taxido - L'avenir des transports pratiques",
                    "meta_tags" => "taxido, ride-hailing, service de taxi, transport, service de voiture, réserver un trajet, transport urbain, covoiturage, taxi fiable, trajets à la demande.",
                    "meta_image" => "/front/images/logo.svg",
                    "meta_title" => "Taxido - Votre partenaire fiable de transport",
                    "og_description" => "Découvrez Taxido, votre solution ultime de transport. Profitez de transports rapides, sûrs et fiables à portée de main. Téléchargez notre application dès aujourd'hui pour une expérience de voyage fluide.",
                    "meta_description" => "Vivez une expérience de transport fluide et pratique avec Taxido. Réservez facilement votre trajet et arrivez à destination en toute sécurité avec notre service de transport fiable et efficace."
                ],
                "analytics" => [
                    "status" => "1",
                    "pixel_id" => "XXXXXXXXXXXXX",
                    "pixel_status" => "1",
                    "measurement_id" => "UA-XXXXXX-XX",
                    "tag_id" => "XXXXXXXXXXXXX",
                ],
            ],
            "de" => [
                "header" => [
                    "logo" => "/front/images/placeholder/142x36.png",
                    "menus" => [
                        'home',
                        'why_taxi_booking',
                        'how_it_works',
                        'faqs',
                        'blogs',
                        'testimonials',
                        'raise_tickets'
                    ],
                    "status" => "1",
                    "btn_url" => "#app",
                    "btn_text" => 'Fahrt buchen',
                ],
                "home" => [
                    "title" => "Fahren Sie mit Komfort, fahren Sie mit Selbstvertrauen",
                    "description" => "Wo Komfort auf Selbstvertrauen trifft—fahren Sie mit Leichtigkeit, fahren Sie mit Stolz und überlassen Sie uns den Rest, um sicherzustellen, dass jede Reise sicher, zuverlässig und wirklich unvergesslich ist.",
                    "button" => [
                        [
                            "text" => "Benutzer-App",
                            "type" => "gradient"
                        ],
                        [
                            "text" => "Fahrer-App",
                            "type" => "outline"
                        ]
                    ],
                    "right_phone_image" => "/front/images/placeholder/1.png",
                    "left_phone_image" => '/front/images/placeholder/2.png',
                    "bg_image" => '',
                    "status" => "1",
                ],
                "statistics" => [
                    "status" => "1",
                    "title" => "Gemeinsam Erfolg fahren",
                    "description" => "Von unzähligen abgeschlossenen Fahrten zu einem florierenden Netzwerk von Nutzern und Fahrern—unsere Reise ist geprägt von Exzellenz und Kundenzufriedenheit.",
                    "counters" => [
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Abgeschlossene Fahrten",
                            "description" => "Täglich vertrauenswürdige Fahrten für unzählige glückliche Fahrgäste.",
                            "count" => "100000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Aktive Nutzer",
                            "description" => "Verbinden Sie sich mit Tausenden, die uns für zuverlässige Fahrten vertrauen.",
                            "count" => "50000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Aktive Fahrer",
                            "description" => "Engagierte Fahrer, die sichere, pünktliche und komfortable Fahrten gewährleisten.",
                            "count" => "30000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "Kundenbewertung",
                            "description" => "Positive Bewertungen, die Vertrauen und Servicequalität widerspiegeln.",
                            "count" => "4.9",
                        ]
                    ]
                ],
                "feature" => [
                    "status" => "1",
                    "title" => "Warum Taxido Ihre bevorzugte Fahrtoption ist",
                    "description" => "Mit Taxido genießen Sie günstige Preise, sichere Fahrten und eine benutzerfreundliche Plattform, die das Reisen einfacher und angenehmer macht als je zuvor.",
                    "images" => [
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Verfolgen Sie Ihren Fahrer live",
                            "description" => "Bleiben Sie über den Standort Ihres Fahrers auf dem Laufenden."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Flexible Fahrzeugvermietung",
                            "description" => "Wählen und mieten Sie Fahrzeuge, die auf Ihre spezifischen Bedürfnisse zugeschnitten sind."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Bietverfahren vereinfacht",
                            "description" => "Akzeptieren oder lehnen Sie Gebote mühelos ab, um die vollständige Kontrolle über Ihre Buchung zu haben."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Praktische Stundenpakete",
                            "description" => "Greifen Sie auf Dienstleistungen in Ihrer bevorzugten Sprache ohne Barrieren zu."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Sprachoptionen für jeden",
                            "description" => "Greifen Sie auf Dienstleistungen in Ihrer bevorzugten Sprache ohne Barrieren zu."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "Sichere Zahlungsmöglichkeiten",
                            "description" => "Mehrere sichere Zahlungsoptionen, die Ihren Vorlieben entsprechen."
                        ],
                    ]
                ],
                "ride" => [
                    "status" => "1",
                    "title" => "Wie Taxido Ihre Fahrt erleichtert",
                    "description" => "Starten Sie in wenigen einfachen Schritten. Wählen Sie Ihre Fahrt, verfolgen Sie Ihren Fahrer und genießen Sie eine reibungslose, stressfreie Fahrt mit Taxido.",
                    "step" => [
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Registrieren",
                            "description" => "Erstellen Sie Ihr Konto in wenigen Minuten, indem Sie Ihre Daten eingeben—schnell und einfach!"
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Legen Sie Ihren Abholort fest",
                            "description" => "Wählen Sie den Ort, an dem Sie abgeholt werden möchten, und überlassen Sie uns den Rest."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Finden Sie Ihren Fahrer",
                            "description" => "Werden Sie mit einem Fahrer in Ihrer Nähe verbunden und verfolgen Sie dessen Standort in Echtzeit."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Schließen Sie Ihre Zahlung ab",
                            "description" => "Bezahlen Sie sicher mit Ihrer bevorzugten Zahlungsmethode über unsere Multi-Gateway-Unterstützung."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "Bewerten Sie Ihre Fahrt",
                            "description" => "Bewerten Sie Ihre Fahrt und helfen Sie uns, uns für noch bessere Erfahrungen in der Zukunft zu verbessern."
                        ]
                    ]
                ],
                "faq" => [
                    "title" => "Häufig gestellte Fragen",
                    "sub_title" => "Haben Sie Fragen? Durchsuchen Sie unsere FAQs für schnelle Antworten zu den Funktionen, Dienstleistungen und der Nutzung der Taxido-App. Eine Fahrt buchen, planen oder Dienstleistungen erkunden? Hier finden Sie alle Antworten.",
                    "faqs" => [],
                    "status" => "1",
                ],
                "blog" => [
                    "title" => "Bleiben Sie mit Taxido auf dem Laufenden",
                    "sub_title" => "Seien Sie der Erste, der spannende Angebote, die neuesten Updates und hilfreiche Reisetipps von Taxido erfährt. Bleiben Sie informiert und machen Sie das Beste aus Ihren Fahrten mit maßgeschneiderten Einblicken und Ankündigungen.",
                    "blogs" => [],
                    "status" => "1",
                ],
                "testimonial" => [
                    "title" => "Was unsere Nutzer sagen",
                    "sub_title" => "Echte Geschichten von unseren zufriedenen Nutzern. Taxido verändert die Art und Weise, wie Menschen pendeln, und bietet sichere, zuverlässige und bequeme Fahrten.",
                    "testimonials" => [],
                    "status" => "1",
                ],
                "footer" => [
                    "footer_logo" => "front/images/placeholder/197x50.png",
                    "description" => "Starten Sie in wenigen Minuten—wählen Sie Ihre Fahrt, verfolgen Sie Ihren Fahrer und genießen Sie eine stressfreie Fahrt mit Taxido!",
                    "newsletter" => [
                        "label" => "Abonnieren Sie unseren Newsletter",
                        "placeholder" => "Geben Sie Ihre E-Mail-Adresse ein",
                        "button_text" => "Abonnieren"
                    ],
                    'play_store_url' => "#!",
                    "app_store_url" => "#!",
                    "quick_links" => [
                        'Startseite',
                        'Warum Taxido?',
                        'Wie es funktioniert',
                        'FAQs',
                        'Blogs',
                        'Erfahrungsberichte',
                    ],
                    "pages" => [],
                    "right_image" => "front/images/placeholder/638x528.png",
                    "copyright" => "© Taxido Alle Rechte vorbehalten -",
                    "status" => "1",
                ],
                "seo" => [
                    "status" => "1",
                    "og_title" => "Taxido - Die Zukunft des bequemen Transports",
                    "meta_tags" => "taxido, ride-hailing, Taxiservice, Transport, Autoservice, Fahrt buchen, Stadtverkehr, Mitfahrgelegenheit, zuverlässiges Taxi, On-Demand-Fahrten.",
                    "meta_image" => "/front/images/logo.svg",
                    "meta_title" => "Taxido - Ihr zuverlässiger Ride-Hailing-Partner",
                    "og_description" => "Entdecken Sie Taxido, Ihre ultimative Ride-Hailing-Lösung. Genießen Sie schnellen, sicheren und zuverlässigen Transport. Laden Sie unsere App noch heute herunter für ein nahtloses Reiseerlebnis.",
                    "meta_description" => "Erleben Sie nahtlosen und bequemen Transport mit Taxido. Buchen Sie Ihre Fahrt einfach und kommen Sie sicher an Ihr Ziel mit unserem zuverlässigen und effizienten Ride-Hailing-Service."
                ],
                "analytics" => [
                    "status" => "1",
                    "pixel_id" => "XXXXXXXXXXXXX",
                    "pixel_status" => "1",
                    "measurement_id" => "UA-XXXXXX-XX",
                    "tag_id" => "XXXXXXXXXXXXX",
                ],
            ],
            "ar" => [
                "header" => [
                    "logo" => "/front/images/placeholder/142x36.png",
                    "menus" => [
                        'home',
                        'why_taxi_booking',
                        'how_it_works',
                        'faqs',
                        'blogs',
                        'testimonials',
                        'raise_tickets'
                    ],
                    "status" => "1",
                    "btn_url" => "#app",
                    "btn_text" => 'فتح تذكرة',
                ],
                "home" => [
                    "title" => "اركب براحة، قُد بثقة",
                    "description" => "حيث تلتقي الراحة بالثقة—اركب بسهولة، قُد بفخر، ودعنا نتعامل مع الباقي، لضمان أن تكون كل رحلة آمنة وموثوقة ولا تُنسى حقًا.",
                    "button" => [
                        [
                            "text" => "تطبيق المستخدم",
                            "type" => "gradient",
                            "url" => "https://play.google.com/store",
                        ],
                        [
                            "text" => "تطبيق السائق",
                            "type" => "outline",
                            "url" => "https://play.google.com/store",
                        ]
                    ],
                    "right_phone_image" => "/front/images/placeholder/1.png",
                    "left_phone_image" => '/front/images/placeholder/2.png',
                    "bg_image" => '',
                    "status" => "1",
                ],
                "statistics" => [
                    "status" => "1",
                    "title" => "قيادة النجاح معًا",
                    "description" => "من عدد لا يحصى من الرحلات المكتملة إلى شبكة مزدهرة من المستخدمين والسائقين، يتم تعريف رحلتنا بالتميز ورضا العملاء.",
                    "counters" => [
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "رحلات مكتملة",
                            "description" => "تقديم رحلات موثوقة لعدد لا يحصى من الركاب السعداء يوميًا.",
                            "count" => "100000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "مستخدمين نشطين",
                            "description" => "التواصل مع الآلاف الذين يثقون بنا لرحلات موثوقة.",
                            "count" => "50000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "سائقين نشطين",
                            "description" => "سائقون مخلصون يضمنون رحلات آمنة وفي الوقت المحدد ومريحة.",
                            "count" => "30000",
                        ],
                        [
                            "icon" => "front/images/placeholder/50x50.png",
                            "text" => "تقييم العملاء",
                            "description" => "تقييمات إيجابية تعكس الثقة وتميز الخدمة.",
                            "count" => "4.9",
                        ]
                    ]
                ],
                "feature" => [
                    "status" => "1",
                    "title" => "لماذا Taxido تبرز كخيارك المفضل للرحلات",
                    "description" => "مع Taxido، استمتع بأسعار معقولة، رحلات آمنة، ومنصة سهلة الاستخدام تجعل السفر أسهل وأكثر متعة من أي وقت مضى.",
                    "images" => [
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "تتبع سائقك مباشرة",
                            "description" => "ابق على اطلاع بموقع سائقك في كل لحظة."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "تأجير مركبات مرن",
                            "description" => "اختر واستأجر مركبات مصممة خصيصًا لاحتياجاتك."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "تبسيط العطاءات",
                            "description" => "اقبل أو ارفض العطاءات بسهولة للتحكم الكامل في الحجز."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "باقات ساعة مريحة",
                            "description" => "الوصول إلى الخدمات بلغتك المفضلة دون عوائق."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "خيارات اللغة للجميع",
                            "description" => "الوصول إلى الخدمات بلغتك المفضلة دون عوائق."
                        ],
                        [
                            "image" => "front/images/placeholder/486x496.png",
                            "title" => "خيارات دفع آمنة",
                            "description" => "خيارات دفع متعددة وآمنة تناسب تفضيلاتك."
                        ],
                    ]
                ],
                "ride" => [
                    "status" => "1",
                    "title" => "كيف تجعل Taxido رحلتك سهلة",
                    "description" => "ابدأ في بضع خطوات بسيطة. اختر رحلتك، تتبع سائقك، واستمتع برحلة سلسة وخالية من المتاعب مع Taxido.",
                    "step" => [
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "سجل",
                            "description" => "أنشئ حسابك في دقائق عن طريق إدخال تفاصيلك—سريع وسهل!"
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "حدد موقع الالتقاط",
                            "description" => "اختر المكان الذي ترغب في الالتقاط منه ودعنا نتعامل مع الباقي."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "ابحث عن سائقك",
                            "description" => "تم إقرانك بسائق قريب وتتبع موقعه في الوقت الفعلي."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "أكمل الدفع",
                            "description" => "ادفع بأمان باستخدام خيار الدفع المفضل لديك من خلال دعمنا متعدد البوابات."
                        ],
                        [
                            "image" => "front/images/placeholder/348x701.png",
                            "title" => "قيم رحلتك",
                            "description" => "قيم رحلتك وساعدنا على التحسين لتجارب أفضل في المستقبل."
                        ]
                    ]
                ],
                "faq" => [
                    "title" => "الأسئلة الشائعة",
                    "sub_title" => "هل لديك أسئلة؟ استكشف الأسئلة الشائعة للحصول على إجابات سريعة حول ميزات Taxido وخدماتها واستخدام التطبيق. حجز رحلة، جدولة، أو استكشاف الخدمات؟ ستجد جميع الإجابات هنا.",
                    "faqs" => [],
                    "status" => "1",
                ],
                "blog" => [
                    "title" => "ابقَ على اطلاع مع Taxido",
                    "sub_title" => "كن أول من يعرف عن العروض المثيرة، آخر التحديثات، ونصائح السفر المفيدة من Taxido. ابقَ على اطلاع واستفد إلى أقصى حد من رحلاتك مع رؤى وإعلانات مصممة خصيصًا لك.",
                    "blogs" => [],
                    "status" => "1",
                ],
                "testimonial" => [
                    "title" => "ما يقوله مستخدمونا",
                    "sub_title" => "قصص حقيقية من مستخدمينا الراضين. Taxido تغير الطريقة التي يتنقل بها الناس، وتوفر رحلات آمنة وموثوقة ومريحة.",
                    "testimonials" => [],
                    "status" => "1",
                ],
                "footer" => [
                    "footer_logo" => "front/images/placeholder/197x50.png",
                    "description" => "ابدأ في دقائق—اختر رحلتك، تتبع سائقك، واستمتع برحلة خالية من المتاعب مع Taxido!",
                    "newsletter" => [
                        "label" => "اشترك في نشرتنا الإخبارية",
                        "placeholder" => "أدخل عنوان البريد الإلكتروني",
                        "button_text" => "اشتراك"
                    ],
                    'play_store_url' => "#!",
                    "app_store_url" => "#!",
                    "quick_links" => [
                        'الرئيسية',
                        'لماذا Taxido؟',
                        'كيف تعمل',
                        'الأسئلة الشائعة',
                        'المدونات',
                        'الشهادات',
                    ],
                    "pages" => [],
                    "right_image" => "front/images/placeholder/638x528.png",
                    "copyright" => "© Taxido جميع الحقوق محفوظة -",
                    "status" => "1",
                ],
                "seo" => [
                    "status" => "1",
                    "og_title" => "Taxido - مستقبل النقل المريح",
                    "meta_tags" => "taxido, ride-hailing, خدمة سيارات الأجرة, نقل, خدمة سيارات, حجز رحلة, نقل حضري, مشاركة الركوب, سيارات أجرة موثوقة, رحلات عند الطلب.",
                    "meta_image" => "/front/images/logo.svg",
                    "meta_title" => "Taxido - شريكك الموثوق في النقل",
                    "og_description" => "اكتشف Taxido، الحل النهائي للنقل. استمتع بنقل سريع وآمن وموثوق في متناول يدك. قم بتنزيل تطبيقنا اليوم لتجربة سفر سلسة.",
                    "meta_description" => "جرب النقل السلس والمريح مع Taxido. احجز رحلتك بسهولة ووصل إلى وجهتك بأمان مع خدمة النقل الموثوقة والفعالة لدينا."
                ],
                "analytics" => [
                    "status" => "1",
                    "pixel_id" => "XXXXXXXXXXXXX",
                    "pixel_status" => "1",
                    "measurement_id" => "UA-XXXXXX-XX",
                    "tag_id" => "XXXXXXXXXXXXX",
                ],
            ],
        ];

        LandingPage::updateOrCreate(['content' => $content]);
    }
}
