<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
    :root {
        --primary: #004aad;
        --primary-hover: #00368b;
    }

    /* ===========================
    FLOATING CONTACT
=========================== */

    .floating-contact {
        position: fixed;
        right: 25px;
        bottom: 30px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        transition: bottom .35s ease;
    }

    /* Arrow visible hone par widget upar */
    .floating-contact.move-up {
        bottom: 100px;
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

    .main-contact-btn {

        width: 60px;
        height: 60px;

        border: none;
        border-radius: 50%;

        background: var(--primary);

        color: #fff;

        cursor: pointer;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 24px;

        box-shadow: 0 6px 18px rgba(0, 0, 0, .25);

        transition: .3s;

    }

    .main-contact-btn:hover {

        background: var(--primary-hover);

    }

    .contact-btn {

        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        color: #fff;
        text-decoration: none;

        font-size: 20px;

        box-shadow: 0 5px 15px rgba(0, 0, 0, .18);

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

    /* ===========================
    BACK TO TOP
=========================== */

    .back-to-top {

        position: fixed;

        right: 30px;
        bottom: 30px;

        width: 50px;
        height: 50px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: var(--primary);

        color: #fff;

        text-decoration: none;

        font-size: 18px;

        box-shadow: 0 8px 20px rgba(0, 0, 0, .25);

        opacity: 0;
        visibility: hidden;

        transform: translateY(20px);

        transition: .35s;

        z-index: 999;

    }

    .back-to-top.show {

        opacity: 1;
        visibility: visible;

        transform: translateY(0);

    }

    .back-to-top:hover {

        background: var(--primary-hover);

        color: #fff;

    }

    /* ===========================
    MOBILE
=========================== */

    @media(max-width:768px) {

        .floating-contact {

            right: 15px;
            bottom: 20px;

        }

        .floating-contact.move-up {

            bottom: 85px;

        }

        .main-contact-btn {

            width: 55px;
            height: 55px;

        }

        .contact-btn {

            width: 48px;
            height: 48px;

        }

        .back-to-top {

            width: 45px;
            height: 45px;

            right: 20px;
            bottom: 20px;

            font-size: 16px;

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

    </div>

    <button class="main-contact-btn" type="button">

        <i class="fas fa-comments"></i>

    </button>

</div>

<a href="javascript:void(0)" id="backToTop" class="back-to-top" title="Back to Top">

    <i class="fa-solid fa-arrow-up"></i>

</a>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        const widget = document.querySelector(".floating-contact");
        const btn = document.querySelector(".main-contact-btn");
        const backToTop = document.getElementById("backToTop");

        // Floating Widget
        btn.addEventListener("click", () => {

            widget.classList.toggle("active");

            btn.innerHTML = widget.classList.contains("active")

                ?
                '<i class="fas fa-times"></i>'

                :
                '<i class="fas fa-comments"></i>';

        });

        // Scroll

        window.addEventListener("scroll", () => {

            if (window.scrollY > 300) {

                backToTop.classList.add("show");

                widget.classList.add("move-up");

            } else {

                backToTop.classList.remove("show");

                widget.classList.remove("move-up");

            }

        });

        // Back To Top

        backToTop.addEventListener("click", () => {

            window.scrollTo({

                top: 0,

                behavior: "smooth"

            });

        });

    });
</script>
