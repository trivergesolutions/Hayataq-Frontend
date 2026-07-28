<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>
    .floating-contact {

        position: fixed;

        right: 25px;

        bottom: 30px;

        z-index: 99999;

    }

    .main-contact-btn {

        width: 60px;

        height: 60px;

        border-radius: 50%;

        border: none;

        background: #004aad;

        color: #fff;

        cursor: pointer;

        font-size: 24px;

        box-shadow: 0 5px 15px rgba(0, 0, 0, .2);

    }

    .contact-options {

        display: flex;

        flex-direction: column;

        gap: 12px;

        margin-bottom: 15px;

        opacity: 0;

        visibility: hidden;

        transform: translateY(20px);

        transition: .35s;

    }

    .floating-contact.active .contact-options {

        opacity: 1;

        visibility: visible;

        transform: translateY(0);

    }

    .contact-btn {

        width: 52px;

        height: 52px;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #fff;

        text-decoration: none;

        font-size: 20px;

        transition: .3s;

    }

    .contact-btn:hover {

        transform: scale(1.08);

    }

    .email {

        background: #2196F3;

    }

    .whatsapp {

        background: #25D366;

    }

    .phone {

        background: #4CAF50;

    }

    .messenger {

        background: #0084ff;

    }

    @media(max-width:768px) {

        .floating-contact {

            right: 15px;

            bottom: 20px;

        }

        .main-contact-btn {

            width: 55px;

            height: 55px;

        }

        .contact-btn {

            width: 48px;

            height: 48px;

        }

    }
</style>
<div class="floating-contact">

    <div class="contact-options">

        <a href="mailto:sales@hayateq.com" class="contact-btn email" title="Email">

            <i class="fas fa-envelope"></i>

        </a>

        <a href="https://wa.me/61410555595" target="_blank" class="contact-btn whatsapp" title="WhatsApp">

            <i class="fab fa-whatsapp"></i>

        </a>

        <a href="tel:+61410555595" class="contact-btn phone" title="Call">

            <i class="fas fa-phone-alt"></i>

        </a>

        {{-- <a href="https://m.me/yourpage" target="_blank" class="contact-btn messenger" title="Messenger">

            <i class="fab fa-facebook-messenger"></i>

        </a> --}}

    </div>

    <button class="main-contact-btn">

        <i class="fas fa-comments"></i>

    </button>

</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {

        const widget = document.querySelector(".floating-contact");

        const btn = document.querySelector(".main-contact-btn");

        btn.addEventListener("click", () => {

            widget.classList.toggle("active");

            btn.innerHTML = widget.classList.contains("active")

                ?
                '<i class="fas fa-times"></i>'

                :
                '<i class="fas fa-comments"></i>';

        });

    });
</script>
