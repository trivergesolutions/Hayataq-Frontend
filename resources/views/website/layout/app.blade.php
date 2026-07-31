<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HAYA TEQ | Industrial Tools & Onsite Machining Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'HAYA TEQ supplies portable machining tools, hydraulic torque systems, flange maintenance equipment, hydrotest pumps, hand torque tools and industrial accessories.')">
    <meta name="keywords" content="@yield('meta_keywords', '')">
    <meta name="theme-color" content="#073f7c">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="preload" href="/website/assests/fonts/clarity-city/ClarityCity-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/website/assests/fonts/clarity-city/ClarityCity-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/website/assests/fonts/clarity-city/ClarityCity-SemiBold.woff2" as="font" type="font/woff2" crossorigin>

    <!-- =============== Fonts (Fisher & Paykel: Clarity City) =============== -->
    {{-- Root-relative URLs so fonts load on any host (localhost / 127.0.0.1 / domain) --}}
    <style>
    @font-face{
      font-family:"Clarity City";
      font-weight:300;
      font-style:normal;
      font-display:swap;
      src:url("/website/assests/fonts/clarity-city/ClarityCity-Light.woff2") format("woff2");
    }
    @font-face{
      font-family:"Clarity City";
      font-weight:400;
      font-style:normal;
      font-display:swap;
      src:url("/website/assests/fonts/clarity-city/ClarityCity-Regular.woff2") format("woff2");
    }
    @font-face{
      font-family:"Clarity City";
      font-weight:500;
      font-style:normal;
      font-display:swap;
      src:url("/website/assests/fonts/clarity-city/ClarityCity-Medium.woff2") format("woff2");
    }
    @font-face{
      font-family:"Clarity City";
      font-weight:600;
      font-style:normal;
      font-display:swap;
      src:url("/website/assests/fonts/clarity-city/ClarityCity-SemiBold.woff2") format("woff2");
    }
    @font-face{
      font-family:"Clarity City";
      font-weight:700;
      font-style:normal;
      font-display:swap;
      src:url("/website/assests/fonts/clarity-city/ClarityCity-Bold.woff2") format("woff2");
    }
    @font-face{
      font-family:"Clarity City";
      font-weight:800;
      font-style:normal;
      font-display:swap;
      src:url("/website/assests/fonts/clarity-city/ClarityCity-ExtraBold.woff2") format("woff2");
    }
    /* Map 900 to ExtraBold so browser never falls back to Arial for heavy weights */
    @font-face{
      font-family:"Clarity City";
      font-weight:900;
      font-style:normal;
      font-display:swap;
      src:url("/website/assests/fonts/clarity-city/ClarityCity-ExtraBold.woff2") format("woff2");
    }
    </style>

    <!-- =============== CSS Styles =============== -->
    <style>
    :root {
      --navy:#06233e;
      --navy2:#09365f;
      --blue:#0b5eb2;
      --blue2:#1e8ed8;
      --cyan:#21a8cb;
      --orange:#f49a2a;
      --ink:#12283c;
      --muted:#62778b;
      --line:#d9e5ee;
      --soft:#f3f8fb;
      --soft2:#eaf5fa;
      --white:#fff;
      --shadow:0 18px 45px rgba(6,35,62,.10);
      --radius:18px;
      /* Same stack as fisherpaykel.com/au */
      --font-family-sans-serif:"Clarity City", Arial, Helvetica, sans-serif;
    }
    *{box-sizing:border-box}
    html{scroll-behavior:smooth;font-family:var(--font-family-sans-serif) !important}
    body{
      margin:0;
      font-family:var(--font-family-sans-serif) !important;
      font-size:14px;
      color:var(--ink);background:#fff;line-height:1.55;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      overflow-x:hidden;
      text-transform:none;
      letter-spacing:.01em;
    }
    img{display:block;max-width:100%}
    a{color:inherit;text-decoration:none}
    button,input,select,textarea{font:inherit}
    .container{width:min(1220px,calc(100% - 42px));margin:auto}
    .topbar{background:var(--navy);color:#d7e4ee;font-size:12px}
    .topbar .container{min-height:36px;display:flex;align-items:center;justify-content:space-between;gap:18px;flex-wrap:wrap}
    .topbar a{color:#fff;font-weight:700}

    /* —— Site header: Fisher & Paykel style (logo + Menu button only) —— */
    .site-header{
      position:sticky;top:0;z-index:100;
      background:rgba(255,255,255,.98);
      border-bottom:1px solid rgba(0,0,0,.06);
      transition:background .35s ease,border-color .35s ease,box-shadow .35s ease;
    }
    .header-scrim{display:none;pointer-events:none}
    .header-inner{
      position:relative;z-index:2;
      height:72px;display:flex;align-items:center;justify-content:space-between;gap:24px;
    }
    .logo-link{display:inline-flex;align-items:center;height:100%;flex:0 0 auto;text-decoration:none}
    .logo{max-height:44px;height:auto;width:auto;max-width:170px;object-fit:contain;display:block;transition:filter .3s ease,opacity .3s ease}

    /* Desktop horizontal nav */
    .desktop-nav{
      display:flex;align-items:center;gap:26px;margin-left:auto;
      font-size:14px;font-weight:600;letter-spacing:.02em;color:#1a1a1a;
    }
    .desktop-nav a{
      position:relative;padding:8px 0;color:inherit;transition:opacity .2s ease;
    }
    .desktop-nav a:hover{opacity:.72}
    .desktop-nav a:after{
      content:"";position:absolute;left:0;right:0;bottom:2px;
      height:1px;width:0;margin:0 auto;background:currentColor;transition:width .25s ease;
    }
    .desktop-nav a:hover:after{width:100%}

    /* Hamburger — mobile only (hidden on desktop) */
    .menu-button{
      display:none;align-items:center;justify-content:center;gap:10px;
      border:0;background:transparent;color:#1a1a1a;
      min-height:44px;padding:0 4px;cursor:pointer;
      font-family:var(--font-family-sans-serif);
      font-size:13px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;
    }
    .menu-icon{display:flex;flex-direction:column;justify-content:center;gap:5px;width:22px}
    .menu-icon span{
      display:block;height:1.5px;width:100%;background:currentColor;
      transition:transform .25s ease,opacity .25s ease;
    }
    body.nav-open .menu-icon span:nth-child(1){transform:translateY(6.5px) rotate(45deg)}
    body.nav-open .menu-icon span:nth-child(2){opacity:0}
    body.nav-open .menu-icon span:nth-child(3){transform:translateY(-6.5px) rotate(-45deg)}

    /* Full-screen style nav panel */
    .nav-overlay{
      position:fixed;inset:0;z-index:200;
      background:rgba(4,18,32,.45);
      opacity:0;visibility:hidden;pointer-events:none;
      transition:opacity .3s ease,visibility .3s ease;
    }
    .nav-overlay.is-open{opacity:1;visibility:visible;pointer-events:auto}
    .nav-panel{
      position:fixed;top:0;right:0;bottom:0;z-index:210;
      width:min(420px,100%);
      background:#fff;color:#1a1a1a;
      box-shadow:-18px 0 50px rgba(0,0,0,.18);
      transform:translateX(100%);
      transition:transform .35s cubic-bezier(.22,.61,.36,1);
      overflow-y:auto;
    }
    .nav-panel.is-open{transform:translateX(0)}
    .nav-panel-inner{padding:22px 28px 40px;min-height:100%;display:flex;flex-direction:column}
    .nav-panel-top{
      display:flex;align-items:center;justify-content:space-between;gap:16px;
      padding-bottom:18px;border-bottom:1px solid #eceff2;margin-bottom:18px;
    }
    .nav-panel-logo img{height:36px;width:auto;max-width:150px;object-fit:contain;display:block}
    .nav-panel-close{
      width:44px;height:44px;border:0;background:transparent;cursor:pointer;
      font-size:32px;line-height:1;color:#1a1a1a;display:inline-flex;align-items:center;justify-content:center;
    }
    .nav-panel-links{display:flex;flex-direction:column;gap:2px;flex:1}
    .nav-panel-links a{
      display:block;padding:14px 2px;
      font-family:var(--font-family-sans-serif);
      font-size:18px;font-weight:500;color:#12283c;
      border-bottom:1px solid #f0f3f5;
      transition:color .2s ease,padding-left .2s ease;
    }
    .nav-panel-links a:hover{color:var(--blue);padding-left:6px}
    .nav-panel-meta{
      margin-top:28px;padding-top:18px;border-top:1px solid #eceff2;
      display:flex;flex-direction:column;gap:8px;
    }
    .nav-panel-meta a{
      font-size:14px;font-weight:600;color:#62778b;
    }
    .nav-panel-meta a:hover{color:var(--navy)}
    body.nav-open{overflow:hidden}

    /* Homepage: transparent topbar + header stacked over hero (from home_page.html) */
    .page-home .topbar{
      display:block;
      position:fixed;top:0;left:0;right:0;z-index:101;
      background:transparent;
      border-bottom:none;
      color:rgba(255,255,255,.88);
      transition:background .35s ease,border-color .35s ease,color .35s ease;
    }
    .page-home .topbar a{color:#fff}
    .page-home .site-header{
      position:fixed;top:36px;left:0;right:0;
      background:transparent;border-bottom-color:transparent;box-shadow:none;
    }
    .page-home .header-scrim{
      display:block;position:fixed;top:0;left:0;right:0;height:108px;z-index:99;
      background:linear-gradient(180deg,rgba(0,0,0,.5) 0%,rgba(0,0,0,.22) 55%,rgba(0,0,0,0) 100%);
      opacity:1;transition:opacity .35s ease;pointer-events:none;
    }
    .page-home .menu-button{color:#fff}
    .page-home .desktop-nav{color:#fff}
    .page-home .logo{filter:brightness(0) invert(1)}

    /* After scroll: solid bars */
    .page-home .site-header.is-solid{
      background:rgba(255,255,255,.98);
      border-bottom-color:rgba(0,0,0,.06);
      box-shadow:0 1px 0 rgba(0,0,0,.04);
    }
    .page-home .site-header.is-solid .menu-button{color:#1a1a1a}
    .page-home .site-header.is-solid .desktop-nav{color:#1a1a1a}
    .page-home .site-header.is-solid .logo{filter:none}
    .page-home .topbar.is-solid{
      background:var(--navy);
      border-bottom:none;
      color:#d7e4ee;
    }
    .page-home .header-scrim.is-solid{opacity:0}
    .page-home .hero{margin-top:0}

    /* Hero video — full height with Designed in Australia + CTAs */
    .hero-video-bg{
      min-height:100vh;
      min-height:100svh;
    }
    .hero-grid-clean{
      grid-template-columns:1fr !important;
      min-height:calc(100vh - 0px) !important;
      min-height:calc(100svh - 0px) !important;
      padding:160px 0 130px !important;
      align-items:center;
    }
    .hero-main{max-width:920px}
    .hero-designed{
      font-family:var(--font-family-sans-serif);
      font-size:clamp(2.55rem,4.2vw,3.35rem);
      font-weight:600;
      line-height:1.2;
      letter-spacing:.08em;
      text-transform:uppercase;
      color:#74d4ef;
      margin:18px 0 0;
    }
    .hero-designed br{display:block;content:""}
    .hero-grid-clean .hero-actions{margin:28px 0 0}

    /* Scroll-down control on video hero (Fisher & Paykel style) */
    .hero-scroll-down{
      position:absolute;
      left:0;right:0;bottom:0;z-index:4;
      width:100%;
      padding:0 16px calc(18px + env(safe-area-inset-bottom,0px));
      box-sizing:border-box;
      display:flex;flex-direction:column;align-items:center;justify-content:flex-end;
      gap:10px;
      color:#fff;text-decoration:none;
      opacity:.95;transition:opacity .2s ease;
      pointer-events:auto;
    }
    .hero-scroll-down:hover{opacity:1;color:#fff}
    /* Text with lines on both sides: "Industrial Tools. Est. 2014" */
    .hero-scroll-line{
      display:flex;align-items:center;justify-content:center;
      gap:12px;
      width:100%;
      max-width:min(560px,100%);
      margin:0 auto;
      box-sizing:border-box;
    }
    .hero-scroll-line-bar{
      flex:1 1 32px;
      height:1px;
      min-width:16px;
      max-width:72px;
      background:rgba(255,255,255,.55);
    }
    .hero-scroll-year{
      flex:0 1 auto;
      max-width:100%;
      font-size:clamp(0.72rem,2.4vw,0.95rem);
      font-weight:500;
      letter-spacing:.08em;
      line-height:1.35;
      color:#fff;
      white-space:nowrap;
      text-align:center;
      overflow:hidden;
      text-overflow:ellipsis;
    }
    /* Mouse / scroll indicator */
    .hero-scroll-down-icon{
      display:inline-flex;align-items:center;justify-content:center;
      flex:0 0 auto;
    }
    .hero-scroll-mouse{
      width:22px;height:34px;border-radius:12px;
      border:1.5px solid rgba(255,255,255,.7);
      position:relative;display:block;
    }
    .hero-scroll-wheel{
      position:absolute;left:50%;top:7px;
      width:3px;height:7px;margin-left:-1.5px;border-radius:2px;
      background:#fff;
      animation:heroScrollWheel 1.6s ease-in-out infinite;
    }
    @keyframes heroScrollWheel{
      0%{transform:translateY(0);opacity:1}
      70%{transform:translateY(10px);opacity:0}
      100%{transform:translateY(0);opacity:0}
    }
    @media (prefers-reduced-motion:reduce){
      .hero-scroll-wheel{animation:none}
    }

    .hero-metrics{
      display:grid;
      grid-template-columns:repeat(4,minmax(0,1fr));
      gap:12px;
      margin-top:42px;
      max-width:860px;
    }
    .hero-metric{
      background:rgba(255,255,255,.08);
      border:1px solid rgba(255,255,255,.14);
      border-radius:12px;
      padding:16px 14px;
      backdrop-filter:blur(6px);
    }
    .hero-metric strong{
      display:block;
      font-family:var(--font-family-sans-serif);
      font-size:28px;
      font-weight:800;
      letter-spacing:.02em;
      color:#fff;
      line-height:1;
      margin-bottom:8px;
    }
    .hero-metric span{
      display:block;
      font-size:12px;
      line-height:1.4;
      color:#c5d8e8;
    }

    .section-head-stack{display:block}
    .section-head-stack .section-copy{max-width:900px}

    /* Trust band */
    /* What sets us apart — same full-bleed dark style as Industries Served */
    .trust-section{
      background:#04182c !important;
      padding:72px 0 !important;
      color:#fff;
    }
    .trust-head{margin-bottom:28px;text-align:left}
    .trust-kicker{
      color:#f49a2a !important;
      font-size:11px !important;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
      display:inline-flex;align-items:center;gap:8px;
    }
    .trust-kicker:before{
      content:"";width:14px;height:1.5px;background:#f49a2a;border-radius:2px;
    }
    .trust-title,
    .trust-section h2.trust-title{
      font-size:clamp(1.15rem,2vw,1.45rem) !important;
      color:#fff !important;
      -webkit-text-fill-color:#fff !important;
      margin:10px 0 0 !important;
      letter-spacing:.05em;
      line-height:1.3 !important;
      max-width:720px;
      font-weight:600 !important;
    }
    .trust-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;align-items:stretch}
    .trust-card{
      border:1px solid rgba(255,255,255,.12);border-radius:14px;
      background:rgba(255,255,255,.05);padding:18px 16px;
      min-height:100%;
      transition:background .2s ease,border-color .2s ease,transform .2s ease;
    }
    .trust-card:hover{
      background:rgba(255,255,255,.08);border-color:rgba(244,154,42,.28);
      transform:translateY(-2px);
    }
    .trust-icon{
      width:40px;height:40px;border-radius:10px;margin-bottom:12px;
      display:flex;align-items:center;justify-content:center;
      background:rgba(244,154,42,.14);color:#f49a2a;
    }
    .trust-icon svg{width:18px;height:18px}
    .trust-card h3{font-size:13px !important;margin:0 0 6px;color:#fff !important;font-weight:700;letter-spacing:.04em}
    .trust-card p{font-size:11px !important;color:#bcd0df;margin:0;line-height:1.45;letter-spacing:.02em}

    /* Technical Enquiry — full-bleed dark like Industries / What sets us apart */
    .contact-section{
      background:#04182c !important;
      padding:100px 0 !important;
      color:#fff;
    }
    .contact-head{margin-bottom:36px}
    .contact-kicker{
      color:#f49a2a !important;
      font-size:12px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;
    }
    .contact-get-started{
      font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.12em;
      color:rgba(255,255,255,.55);margin:10px 0 0;
    }
    .contact-title,
    .contact-section h2.contact-title{
      font-size:clamp(1.45rem,2.6vw,2rem) !important;
      color:#fff !important;
      line-height:1.2 !important;
      max-width:820px;
      margin:12px 0 16px !important;
      font-weight:600 !important;
      letter-spacing:.04em;
    }
    .contact-lead{
      color:#a9bfd1 !important;
      font-size:13px;line-height:1.55;max-width:720px;margin:0 !important;
      letter-spacing:.03em;
    }
    .contact-chips{display:flex;flex-wrap:wrap;gap:8px;margin:0 0 20px}
    .contact-chips span{
      display:inline-flex;align-items:center;padding:9px 14px;border-radius:999px;
      background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.16);
      font-size:12px;font-weight:600;color:#fff;
    }
    .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:47px;padding:0 19px;border-radius:8px;border:1px solid transparent;font-size:13px;font-weight:700;text-transform:none;letter-spacing:.02em;cursor:pointer;transition:.2s}
    .btn-primary{background:linear-gradient(135deg,var(--blue),var(--blue2));color:#fff;box-shadow:0 12px 24px rgba(11,94,178,.22)}
    .btn-primary:hover{transform:translateY(-1px);box-shadow:0 16px 30px rgba(11,94,178,.28)}
    .btn-outline{background:#fff;border-color:#b9cad7;color:var(--navy)}
    .btn-light{background:#fff;color:var(--navy)}
    .btn-ghost{background:rgba(255,255,255,.10);border-color:rgba(255,255,255,.28);color:#fff}
    /* Hero CTA — transparent / glass on video */
    .btn-hero{
      min-height:52px;
      padding:0 28px;
      border-radius:6px;
      border:1px solid rgba(255,255,255,.55);
      background:transparent;
      color:#fff !important;
      font-size:13px !important;
      font-weight:700 !important;
      letter-spacing:.06em !important;
      text-transform:uppercase !important;
      box-shadow:none;
      backdrop-filter:blur(2px);
      -webkit-backdrop-filter:blur(2px);
      gap:10px;
      transition:background .2s ease,border-color .2s ease,transform .2s ease,box-shadow .2s ease;
    }
    .btn-hero span{font-size:15px;line-height:1;transition:transform .2s ease}
    .btn-hero:hover{
      transform:translateY(-2px);
      background:rgba(255,255,255,.12);
      border-color:rgba(255,255,255,.9);
      box-shadow:0 8px 24px rgba(0,0,0,.18);
      color:#fff !important;
    }
    .btn-hero:hover span{transform:translateX(3px)}
    .hero-actions .btn-hero{margin-top:4px}
    .hero{
      position:relative;overflow:hidden;color:#fff;
      background-color:#06233e;
    }
    /* Fisher & Paykel–style full-bleed video background */
    .hero-video-wrap{
      position:absolute;inset:0;z-index:0;overflow:hidden;background:#06233e;
    }
    .hero-video{
      position:absolute;inset:0;width:100%;height:100%;
      object-fit:cover;object-position:center center;
      opacity:0;transition:opacity 1.1s ease;
      pointer-events:none;
    }
    .hero-video.is-active{opacity:1;z-index:1}
    .hero-video-overlay{
      position:absolute;inset:0;z-index:2;pointer-events:none;
      background:
        linear-gradient(90deg,rgba(5,27,49,.88) 0%,rgba(7,42,75,.72) 42%,rgba(7,42,75,.45) 68%,rgba(7,42,75,.28) 100%),
        radial-gradient(circle at 80% 20%,rgba(30,142,216,.22),transparent 30%),
        radial-gradient(circle at 12% 88%,rgba(33,168,203,.14),transparent 32%);
    }
    .hero-video-bg .hero-grid{position:relative;z-index:3}
    .hero:before{display:none}
    .hero-grid{position:relative;display:grid;grid-template-columns:1.05fr .95fr;gap:52px;align-items:center;min-height:690px;padding:70px 0}
    .eyebrow{display:inline-flex;align-items:center;gap:8px;padding:8px 11px;border-radius:999px;border:1px solid rgba(255,255,255,.18);background:rgba(255,255,255,.09);font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.1em}
    .eyebrow i{width:8px;height:8px;border-radius:50%;background:var(--orange);display:inline-block}
    .hero h1{font-size:clamp(3rem,5.5vw,5.5rem);line-height:.98;letter-spacing:-.035em;margin:21px 0 19px;max-width:820px}
    .hero h1 span{color:#74d4ef}
    .hero-lead{font-size:18px;color:#d5e4f1;max-width:700px;margin:0}
    .hero-actions{display:flex;gap:11px;flex-wrap:wrap;margin:28px 0 31px}
    .hero-points{display:grid;grid-template-columns:repeat(2,1fr);gap:11px;max-width:690px}
    .hero-point{display:flex;gap:11px;align-items:flex-start;padding:13px 14px;border-radius:10px;background:rgba(255,255,255,.075);border:1px solid rgba(255,255,255,.12)}
    .hero-check{width:25px;height:25px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:var(--orange);color:#071b30;font-weight:900;flex:0 0 auto}
    .hero-point strong{display:block;font-size:13px}
    .hero-point span{display:block;color:#bad0e1;font-size:12px;margin-top:2px}
    .hero-product-stage{position:relative;min-height:530px;display:flex;align-items:center;justify-content:center}
    .stage-panel{position:absolute;inset:23px;border:1px solid rgba(255,255,255,.15);border-radius:30px;background:linear-gradient(160deg,rgba(255,255,255,.12),rgba(255,255,255,.04));backdrop-filter:blur(8px);box-shadow:0 30px 80px rgba(0,0,0,.28)}
    .stage-panel:before{content:"";position:absolute;width:330px;height:330px;border-radius:50%;background:radial-gradient(circle,rgba(34,168,203,.32),rgba(34,168,203,0));left:50%;top:50%;transform:translate(-50%,-50%)}
    .hero-machine{position:relative;width:96%;max-height:490px;object-fit:contain;filter:drop-shadow(0 30px 25px rgba(0,0,0,.32))}
    .stage-tag{position:absolute;background:#fff;color:var(--ink);padding:15px 17px;border-radius:12px;box-shadow:var(--shadow);max-width:240px}
    .stage-tag strong{display:block;color:var(--navy);font-size:14px;margin-bottom:4px}
    .stage-tag span{display:block;color:var(--muted);font-size:12px}
    .stage-tag.one{left:-6px;bottom:44px}
    .stage-tag.two{right:-2px;top:54px}
    .quick-strip{position:relative;margin-top:-35px;z-index:5}
    .quick-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:13px}
    .quick-card{background:#fff;border:1px solid var(--line);border-radius:15px;padding:20px;box-shadow:var(--shadow);display:flex;gap:13px;align-items:flex-start}
    .quick-icon{width:46px;height:46px;border-radius:12px;background:linear-gradient(135deg,#e9f5fd,#f6fbff);display:flex;align-items:center;justify-content:center;color:var(--blue);font-weight:900;flex:0 0 auto}
    .quick-card strong{display:block;color:var(--navy);font-size:14px;margin-bottom:4px}
    .quick-card span{font-size:12px;color:var(--muted)}
    .section{padding:88px 0}
    .section.soft{background:var(--soft)}
    .section.blue-soft{background:linear-gradient(180deg,#edf8fc,#f7fbfd)}
    .section.dark{background:var(--navy);color:#fff}
    .section-head{display:flex;justify-content:space-between;align-items:flex-end;gap:26px;margin-bottom:35px}
    .section-copy{max-width:780px}
    .kicker{color:var(--blue);font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em}
    .section h2{font-size:clamp(1.45rem,2.5vw,2rem);line-height:1.2;letter-spacing:.04em;margin:10px 0 0;color:var(--navy);font-weight:600}
    .section.dark h2{color:#fff}
    .section-copy p{color:var(--muted);margin:13px 0 0}
    .section.dark .section-copy p{color:#bed0df}
    .section-action{flex:0 0 auto}
    .category-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px;align-items:stretch}
    .category-card{
      background:#fff;border:1px solid var(--line);border-radius:17px;overflow:hidden;box-shadow:var(--shadow);
      transition:.22s;display:flex;flex-direction:column;height:100%;
    }
    .category-card:hover{transform:translateY(-4px);box-shadow:0 24px 52px rgba(6,35,62,.14)}
    .category-image{height:190px;display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg,#fbfdff,#eef5f9);padding:20px;position:relative;flex:0 0 auto}
    .category-image img{width:100%;height:100%;object-fit:contain}
    .category-number{position:absolute;right:13px;top:11px;color:#c4d8e7;font-size:20px;font-weight:700}
    .category-content{
      padding:19px;display:flex;flex-direction:column;flex:1 1 auto;min-height:0;
    }
    .category-content h3{font-size:14px;line-height:1.25;color:var(--navy);margin:0 0 8px;font-weight:700;letter-spacing:.03em}
    .category-content p{font-size:12px;color:var(--muted);margin:0 0 14px;flex:1 1 auto;line-height:1.45;letter-spacing:.02em}
    .category-link{
      margin-top:auto;
      white-space:nowrap;
      flex-shrink:0;
      font-size:11px;
      letter-spacing:.03em;
      gap:6px;
    }
    .text-link{display:inline-flex;align-items:center;gap:8px;font-size:12px;color:var(--blue);font-weight:700;text-transform:none;letter-spacing:.02em}
    .text-link span{font-size:18px;line-height:0}
    .category-link span{font-size:15px;line-height:0}
    .featured-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:19px}
    .product-card{background:#fff;border:1px solid var(--line);border-radius:18px;overflow:hidden;box-shadow:var(--shadow);transition:.22s}
    .product-card:hover{transform:translateY(-4px);box-shadow:0 24px 52px rgba(6,35,62,.14)}

    /* Featured Products — 4 dark cards from home_page_change.png */
    .featured-feature-grid{
      display:grid;grid-template-columns:repeat(4,1fr);gap:16px;align-items:stretch;
    }
    .featured-feature-card{
      background:linear-gradient(165deg,#0a2744 0%,#06233e 55%,#04182c 100%);
      color:#fff;border-radius:18px;padding:26px 22px 22px;
      display:flex;flex-direction:column;min-height:100%;
      border:1px solid rgba(255,255,255,.08);
      box-shadow:0 18px 40px rgba(6,35,62,.16);
      transition:transform .22s ease,box-shadow .22s ease;
    }
    .featured-feature-card:hover{
      transform:translateY(-4px);
      box-shadow:0 24px 52px rgba(6,35,62,.22);
    }
    .featured-feature-card h3{
      font-size:15px;line-height:1.25;color:#fff;margin:0 0 10px;letter-spacing:.03em;font-weight:700;
    }
    .featured-feature-card > p{
      font-size:13px;line-height:1.5;color:#b7c9d8;margin:0 0 16px;
    }
    .featured-feature-card ul{
      list-style:none;margin:0 0 22px;padding:0;flex:1 1 auto;
    }
    .featured-feature-card li{
      position:relative;padding:0 0 8px 16px;
      font-size:13px;line-height:1.4;color:#d5e3ef;
    }
    .featured-feature-card li:before{
      content:"";position:absolute;left:0;top:8px;
      width:6px;height:6px;border-radius:50%;background:#74d4ef;
    }
    .featured-feature-btn{
      margin-top:auto;width:100%;min-height:44px;border-radius:10px;
      background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);
      color:#fff;font-size:13px;font-weight:700;letter-spacing:.02em;text-transform:none;
    }
    .featured-feature-btn:hover{
      background:rgba(255,255,255,.2);color:#fff;transform:none;
      box-shadow:none;
    }
    .product-image{height:260px;background:linear-gradient(180deg,#fcfeff,#edf4f8);padding:22px;display:flex;align-items:center;justify-content:center;position:relative}
    .product-image img{width:100%;height:100%;object-fit:contain}
    .product-category{position:absolute;left:14px;top:14px;background:var(--navy);color:#fff;border-radius:5px;padding:7px 9px;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:.055em}
    .product-content{padding:20px}
    .product-content h3{font-size:19px;line-height:1.2;color:var(--navy);margin:0 0 10px}
    .product-content p{color:var(--muted);font-size:13px;margin:0 0 15px}
    .solution-layout{display:grid;grid-template-columns:1fr 1fr;gap:25px;align-items:stretch}
    .solution-image{min-height:500px;border-radius:22px;overflow:hidden;position:relative}
    .solution-image img{width:100%;height:100%;object-fit:cover}
    .solution-image:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 50%,rgba(6,35,62,.72))}
    .solution-image-caption{position:absolute;left:27px;right:27px;bottom:24px;color:#fff;z-index:2}
    .solution-image-caption strong{display:block;font-size:16px;margin-bottom:6px;letter-spacing:.03em}
    .solution-image-caption span{font-size:12px;color:#d5e4ef}
    .solution-cards{display:grid;grid-template-columns:repeat(2,1fr);gap:15px}
    .solution-card{background:#fff;border:1px solid var(--line);border-radius:16px;padding:21px;box-shadow:var(--shadow)}
    .solution-card i{width:40px;height:40px;border-radius:10px;background:#eaf5fc;color:var(--blue);display:flex;align-items:center;justify-content:center;font-style:normal;font-weight:800;margin-bottom:12px;font-size:13px}
    .solution-card h3{color:var(--navy);font-size:14px;margin:0 0 8px;font-weight:700;letter-spacing:.03em}
    .solution-card p{color:var(--muted);font-size:12px;margin:0;line-height:1.45}
    /* Industries Served — full-bleed dark section matching design */
    .industries-section{
      background:#04182c !important;
      padding:100px 0 !important;
    }
    .industries-kicker{
      color:#74d4ef !important;
      font-size:12px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;
    }
    .industries-title,
    .industries-section h2.industries-title{
      color:#fff !important;
      font-size:clamp(1.45rem,2.6vw,2rem) !important;
      line-height:1.2 !important;
      max-width:820px;
      margin:12px 0 16px !important;
      font-weight:600 !important;
      letter-spacing:.04em;
    }
    .industries-lead{
      color:#a9bfd1 !important;
      font-size:13px;line-height:1.55;max-width:720px;margin:0 0 8px !important;
      letter-spacing:.03em;
    }
    .industries-head{margin-bottom:40px}
    .industry-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;align-items:stretch}
    .industry-card{
      border:1px solid rgba(255,255,255,.12);border-radius:16px;
      background:rgba(255,255,255,.05);padding:22px 20px;
      min-height:100%;transition:background .2s ease,border-color .2s ease,transform .2s ease;
    }
    .industry-card:hover{
      background:rgba(255,255,255,.08);border-color:rgba(116,212,239,.28);
      transform:translateY(-2px);
    }
    .industry-icon{
      width:56px;height:56px;border-radius:12px;
      background:rgba(255,255,255,.1);
      display:flex;align-items:center;justify-content:center;
      margin-bottom:15px;flex:0 0 auto;padding:10px;
    }
    .industry-icon img{
      width:36px;height:36px;object-fit:contain;display:block;
      /* Force icons to pure white on dark cards */
      filter:brightness(0) invert(1);
      opacity:1;
    }
    .industry-card h3{font-size:14px;margin:0 0 8px;color:#fff !important;font-weight:700;letter-spacing:.03em}
    .industry-card p{font-size:12px;color:#bcd0df;margin:0;line-height:1.45;letter-spacing:.02em}
    .why-grid{display:grid;grid-template-columns:.92fr 1.08fr;gap:42px;align-items:center}
    .why-image{position:relative;border-radius:22px;overflow:hidden;box-shadow:var(--shadow)}
    .why-image img{width:100%;min-height:470px;object-fit:cover}
    .why-image-label{position:absolute;left:20px;bottom:20px;background:#fff;border-radius:11px;padding:15px 17px;max-width:280px;box-shadow:var(--shadow)}
    .why-image-label strong{display:block;color:var(--navy);font-size:14px;margin-bottom:4px}
    .why-image-label span{font-size:12px;color:var(--muted)}
    .why-copy h2{font-size:clamp(1.45rem,2.5vw,2rem);line-height:1.2;color:var(--navy);margin:10px 0 14px;font-weight:600;letter-spacing:.04em}
    .why-copy>p{color:var(--muted);margin:0 0 21px}
    .why-points{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
    .why-point{display:flex;gap:11px;padding:14px;border-radius:12px;background:#fff;border:1px solid var(--line)}
    .why-point b{width:29px;height:29px;border-radius:50%;background:var(--orange);display:flex;align-items:center;justify-content:center;flex:0 0 auto;color:#11273b}
    .why-point strong{display:block;color:var(--navy);font-size:13px}
    .why-point span{display:block;color:var(--muted);font-size:12px;margin-top:2px}
    .resources-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:17px}
    .resource-card{background:#fff;border:1px solid var(--line);border-radius:16px;padding:23px;box-shadow:var(--shadow)}
    .resource-icon{width:48px;height:48px;border-radius:12px;background:#eaf5fc;color:var(--blue);display:flex;align-items:center;justify-content:center;font-weight:900;margin-bottom:16px}
    .resource-card h3{font-size:14px;color:var(--navy);margin:0 0 8px;font-weight:700;letter-spacing:.03em}
    .resource-card p{font-size:12px;color:var(--muted);margin:0 0 14px;line-height:1.45}
    .contact-band{
      display:grid;grid-template-columns:.85fr 1.15fr;gap:28px;align-items:stretch;
    }
    .contact-copy{color:#fff}
    .contact-detail{
      border:1px solid rgba(255,255,255,.14);border-radius:14px;
      background:rgba(255,255,255,.05);padding:14px 16px;margin-top:10px;
    }
    .contact-detail small{display:block;color:#aac2d6;margin-bottom:3px}
    .contact-detail strong,.contact-detail a{color:#fff}
    .contact-form{
      background:rgba(255,255,255,.05);color:#fff;
      border:1px solid rgba(255,255,255,.12);border-radius:16px;padding:24px;
    }
    .contact-form h3{color:#fff !important;margin:0 0 15px}
    .contact-section .field label{color:#c5d5e3}
    .contact-section .field input,
    .contact-section .field select,
    .contact-section .field textarea{
      background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.18);color:#fff;
    }
    .contact-section .field input::placeholder,
    .contact-section .field textarea::placeholder{color:rgba(255,255,255,.4)}
    .contact-section .field select option{color:#12283c;background:#fff}
    .form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
    .field{margin-bottom:12px}
    .field.full{grid-column:1/-1}
    .field label{display:block;color:#314d64;font-size:12px;font-weight:600;text-transform:none;letter-spacing:.01em;margin-bottom:6px}
    .field input,.field select,.field textarea{width:100%;min-height:45px;border:1px solid #bdceda;border-radius:8px;padding:10px 12px;background:#fff}
    .field textarea{min-height:105px;resize:vertical}
    /* Footer — light section variation (like other light bands), black text */
    .footer{
      background:var(--soft);
      color:#12283c;
      padding:72px 0 0;
      border-top:1px solid var(--line);
    }
    .footer-grid{
      display:grid;grid-template-columns:1.4fr .75fr .9fr .9fr;gap:28px;
      padding-bottom:40px;
    }
    .footer-logo{
      width:190px;max-width:100%;height:auto;
      background:#fff;border-radius:10px;padding:10px;
      margin-bottom:16px;border:1px solid var(--line);
      box-shadow:0 8px 24px rgba(6,35,62,.06);
    }
    .footer p{
      font-size:13px;line-height:1.55;
      color:#12283c !important;margin:0 0 10px;
    }
    .footer p strong{color:#000 !important;font-weight:700}
    .footer h4{
      color:#000 !important;margin:0 0 16px;font-size:15px;font-weight:800;
      letter-spacing:.02em;text-transform:uppercase;
    }
    .footer a{
      display:block;color:#12283c !important;font-size:13px;margin:8px 0;
      transition:color .2s ease,padding-left .2s ease;
    }
    .footer a:hover{color:var(--blue) !important;padding-left:4px}
    .copyright{
      border-top:1px solid var(--line);
      padding:18px 0;text-align:center;
      color:#12283c !important;font-size:12px;
      background:rgba(255,255,255,.45);
    }
    /* —— Tablet (landscape / large tablet) —— */
    @media(max-width:1200px){
      .category-grid{grid-template-columns:repeat(3,1fr);gap:14px}
      .featured-feature-grid{grid-template-columns:repeat(2,1fr);gap:14px}
      .industry-grid{grid-template-columns:repeat(3,1fr)}
      .trust-grid{grid-template-columns:repeat(2,1fr)}
      .resources-grid{grid-template-columns:repeat(3,1fr);gap:14px}
    }
    @media(max-width:1080px){
      .desktop-nav{display:none}
      .menu-button{display:inline-flex}
      .hero-grid{grid-template-columns:1fr}
      .hero-product-stage{min-height:420px}
      .hero-grid-clean{padding:140px 0 120px !important}
      .category-grid{grid-template-columns:repeat(2,1fr)}
      .quick-grid{grid-template-columns:repeat(2,1fr)}
      .industry-grid{grid-template-columns:repeat(2,1fr);gap:12px}
      .why-grid,.solution-layout,.contact-band{grid-template-columns:1fr;gap:28px}
      .solution-image{min-height:380px}
      .featured-grid{grid-template-columns:repeat(2,1fr)}
      .featured-feature-grid{grid-template-columns:repeat(2,1fr)}
      .footer-grid{grid-template-columns:repeat(2,1fr);gap:24px}
      .section{padding:72px 0}
      .industries-section{padding:80px 0 !important}
      .trust-section{padding:64px 0 !important}
      .contact-section{padding:80px 0 !important}
      .why-points{grid-template-columns:repeat(2,1fr)}
      .solution-cards{grid-template-columns:repeat(2,1fr)}
      .hero-scroll-line{gap:14px;max-width:min(480px,92%)}
      .hero-scroll-year{font-size:0.88rem;letter-spacing:.07em}
      .section h2,.industries-title,.contact-title,.why-copy h2{
        font-size:clamp(1.25rem,2.4vw,1.75rem) !important;
      }
      .category-link{white-space:normal}
    }
    /* —— Tablet portrait —— */
    @media(max-width:900px){
      .hero-grid-clean{padding:120px 0 110px !important}
      .hero-designed{font-size:clamp(1.35rem,3vw,1.85rem);letter-spacing:.06em}
      .btn-hero{min-height:48px;padding:0 22px;font-size:12px !important}
      .featured-feature-card{padding:22px 18px 18px}
      .featured-feature-card h3{font-size:14px}
      .industry-card{padding:18px 16px}
      .industry-icon{width:48px;height:48px}
      .industry-icon img{width:30px;height:30px}
      .resources-grid{grid-template-columns:1fr 1fr}
      .contact-chips{gap:6px}
    }
    /* —— Mobile —— */
    @media(max-width:720px){
      .container{width:min(100% - 24px,680px)}
      .topbar .container{min-height:32px;font-size:11px;justify-content:center;text-align:center;padding:4px 0}
      .topbar .container span:first-child{display:none}
      .page-home .site-header{top:32px}
      .page-home .header-scrim{height:96px}
      .header-inner{height:60px;gap:12px}
      .logo-link{height:100%}
      .logo{max-height:36px;height:auto;width:auto;max-width:136px;object-fit:contain}
      .nav-panel{width:min(100%,400px);max-width:100%}
      .nav-panel-links a{font-size:16px;padding:12px 0}

      /* Hero */
      .hero-grid{grid-template-columns:1fr;padding:36px 0 46px;min-height:auto;gap:24px}
      .hero-grid-clean{
        padding:110px 0 108px !important;
        min-height:calc(100svh - 0px) !important;
      }
      .hero-video-bg{min-height:100svh;min-height:100dvh}
      .hero h1{font-size:clamp(2rem,8vw,2.75rem);line-height:1.05;margin:14px 0}
      .hero-designed{
        font-size:clamp(1.25rem,5.2vw,1.55rem);
        letter-spacing:.05em;
        margin-top:12px;
        max-width:18em;
      }
      .hero-actions{margin:18px 0 0;gap:10px}
      .hero-actions .btn-hero{
        width:auto;max-width:100%;
        min-height:48px;padding:0 20px;
        font-size:11px !important;letter-spacing:.05em !important;
      }
      .hero-metrics{grid-template-columns:1fr 1fr;margin-top:24px;gap:10px}
      .hero-product-stage{display:none}

      /* Industrial Tools. Est. 2014 — mobile */
      .hero-scroll-down{
        padding:0 12px calc(12px + env(safe-area-inset-bottom,0px));
        gap:8px;
      }
      .hero-scroll-line{
        gap:8px;
        max-width:100%;
        padding:0 4px;
      }
      .hero-scroll-line-bar{
        flex:1 1 12px;
        min-width:10px;
        max-width:36px;
      }
      .hero-scroll-year{
        font-size:clamp(0.68rem,3.1vw,0.82rem);
        letter-spacing:.04em;
        white-space:nowrap;
        line-height:1.3;
      }
      .hero-scroll-mouse{width:18px;height:28px;border-radius:10px}
      .hero-scroll-wheel{top:6px;height:6px}

      /* Grids → single / dual column */
      .hero-points,.quick-grid,.category-grid,.featured-grid,
      .featured-feature-grid,.solution-cards,.industry-grid,
      .why-points,.resources-grid,.form-grid,.footer-grid,
      .trust-grid{grid-template-columns:1fr !important;gap:12px}
      .category-grid{grid-template-columns:1fr !important}
      .industry-grid{grid-template-columns:1fr 1fr !important;gap:10px}
      .trust-grid{grid-template-columns:1fr 1fr !important;gap:10px}

      .section{padding:48px 0}
      .section-head{display:block;margin-bottom:24px}
      .section h2,.industries-title,.contact-title,.why-copy h2,.trust-title{
        font-size:clamp(1.15rem,5vw,1.4rem) !important;
        line-height:1.25 !important;
        letter-spacing:.03em !important;
      }
      .section-copy p,.industries-lead,.contact-lead,.why-copy>p{
        font-size:13px;line-height:1.55;
      }
      .kicker,.industries-kicker,.trust-kicker,.contact-kicker{
        font-size:10px !important;letter-spacing:.08em;
      }

      .category-image{height:200px}
      .category-content{padding:16px}
      .category-content h3{font-size:13px}
      .category-link{white-space:normal;font-size:11px}

      .featured-feature-card{padding:20px 16px 16px;border-radius:14px}
      .featured-feature-card h3{font-size:13px}
      .featured-feature-card > p,
      .featured-feature-card li{font-size:12px}

      .solution-image{min-height:280px;border-radius:16px}
      .solution-image-caption{left:16px;right:16px;bottom:16px}
      .solution-image-caption strong{font-size:14px}
      .solution-card{padding:16px}
      .solution-cards{grid-template-columns:1fr !important}

      .industries-section{padding:52px 0 !important}
      .industries-head{margin-bottom:24px}
      .industry-card{padding:14px 12px;border-radius:12px}
      .industry-card h3{font-size:12px}
      .industry-card p{font-size:11px}
      .industry-icon{width:44px;height:44px;margin-bottom:10px;padding:8px}
      .industry-icon img{width:26px;height:26px}

      .why-image img{min-height:260px}
      .why-points{grid-template-columns:1fr !important}
      .why-point{padding:12px}

      .trust-section{padding:48px 0 !important}
      .trust-card{padding:14px 12px}
      .trust-card h3{font-size:12px !important}
      .trust-card p{font-size:11px !important}

      .resources-grid{grid-template-columns:1fr !important}
      .resource-card{padding:18px}

      .contact-section{padding:52px 0 !important}
      .contact-band{gap:20px}
      .contact-chips span{font-size:11px;padding:8px 11px}
      .contact-form{padding:18px}
      .form-grid{grid-template-columns:1fr !important}

      .footer-grid{grid-template-columns:1fr !important;gap:22px}
      .footer{padding:48px 0 0}
      .section-action{margin-top:16px}
      .product-image{height:260px}
    }
    /* —— Small phones —— */
    @media(max-width:480px){
      .container{width:calc(100% - 20px)}
      .logo{max-height:32px;max-width:118px}
      .header-inner{height:56px}
      .hero-grid-clean{padding:100px 0 100px !important}
      .hero h1{font-size:1.7rem}
      .hero-designed{font-size:1.2rem;letter-spacing:.04em;max-width:100%}
      .hero-actions{flex-direction:column;align-items:stretch}
      .hero-actions .btn,
      .hero-actions .btn-hero{width:100%;justify-content:center;max-width:100%}
      .hero-machine{max-width:260px;max-height:230px}

      .hero-scroll-down{
        padding:0 10px calc(10px + env(safe-area-inset-bottom,0px));
        gap:6px;
      }
      .hero-scroll-line{gap:6px}
      .hero-scroll-line-bar{min-width:8px;max-width:24px;flex-basis:10px}
      .hero-scroll-year{
        font-size:0.66rem;
        letter-spacing:.03em;
      }
      .hero-scroll-mouse{width:16px;height:24px}

      .industry-grid,
      .trust-grid{grid-template-columns:1fr !important}
      .section{padding:40px 0}
      .industries-section,.contact-section,.trust-section{padding:44px 0 !important}
      .category-image{height:180px}
      .featured-feature-btn{min-height:42px;font-size:12px}
    }
    /* Very narrow phones — allow Est. line to wrap cleanly */
    @media(max-width:360px){
      .hero-scroll-year{
        white-space:normal;
        font-size:0.64rem;
        letter-spacing:.02em;
        max-width:11.5rem;
      }
      .hero-scroll-line-bar{max-width:18px}
    }
    /* Clarity City sitewide — casing rules:
       1) Header (top bar + nav): UPPERCASE
       2) Section / card titles only: UPPERCASE
       3) Body copy: normal sentence case (first letter upper, rest as written) */
    body,button,input,select,textarea,
    h1,h2,h3,h4,h5,h6,.eyebrow,.kicker,.btn,
    p,li,span,label,a,strong,b,small,div,td,th,.container,.site-header,.nav-panel,.hero,.section,.footer{
      font-family:"Clarity City", Arial, Helvetica, sans-serif !important;
    }

    /* Default: sentence case (not forced uppercase) */
    body,p,li,label,input,select,textarea,
    .hero-lead,.contact-lead,.category-content p,.featured-feature-card p,
    .featured-feature-card ul,.featured-feature-card li,.trust-card p,
    .industry-card p,.why-copy p,.solution-card p,.resource-card p,
    .footer p,.footer a,.copyright,.contact-chips span,.form-note,
    .hero-scroll-year{
      text-transform:none !important;
      letter-spacing:.01em;
    }

    /* Header section — all uppercase */
    .topbar,
    .topbar a,
    .site-header,
    .site-header a,
    .desktop-nav,
    .desktop-nav a,
    .menu-button,
    .nav-panel,
    .nav-panel a,
    .nav-panel-links a,
    .nav-panel-meta a{
      text-transform:uppercase !important;
      letter-spacing:.06em;
    }

    /* Titles only (outside header) — uppercase */
    h1,h2,h3,h4,h5,h6,
    .kicker,.eyebrow,.trust-kicker,.contact-kicker,.contact-get-started,
    .industries-kicker,.industries-title,.hero-designed,
    .section-copy h2,.section-head h2,.trust-title,.contact-title,
    .category-content h3,.featured-feature-card h3,.trust-card h3,
    .industry-card h3,.why-copy h2,.why-points h3,.solution-card h3,
    .resource-card h3,.product-category,.category-code,.footer h4{
      text-transform:uppercase !important;
      letter-spacing:.04em;
      font-weight:600;
    }

    /* Buttons / links stay sentence case for readability */
    .btn:not(.btn-hero),.text-link,.category-link{
      text-transform:none !important;
      letter-spacing:.02em;
      font-weight:700;
    }
    .kicker{font-weight:700}
    input,select,textarea{letter-spacing:.02em;font-size:13px}
    .nav-panel-links a{font-size:15px !important;letter-spacing:.06em}
    .desktop-nav{font-size:12px !important;letter-spacing:.06em}
    .btn:not(.btn-hero){font-size:13px !important;letter-spacing:.02em;min-height:42px}
    .btn-hero{
      text-transform:uppercase !important;
      letter-spacing:.06em !important;
      font-size:13px !important;
      min-height:52px;
    }
    /* Theme color for text */
    .white-text{
      color: #fff !important;
    }
    .dark-text{
      color: #06233e !important;
    }
    .bg-white{
      background: #fff !important;
    }
    .bg-white ul li{
      color: #06233e !important;
    }
    .btn-dark-text-white{
       background: #06233e !important;
       color: #fff !important;
    }
    .btn-white-text-dark{
       background: #fff !important;
       color: #06233e !important;
    }
    .orange-text{
      color:#f49a2a !important;
    }
    .btn-hero {
    opacity: 0;
    transform: translateY(25px);
    animation: heroButtonFadeUp .8s ease-out .5s forwards;
}

@keyframes heroButtonFadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.ml-0{margin-left:0px !important;}
    </style>
    @stack('styles')
</head>

<body class="@yield('body_class')">
    @include('website.layout.header')

    @yield('content')
    
    @include('website.layout.footer')

    <script>
    (function () {
        const header = document.getElementById('siteHeader');
        const menuButton = document.getElementById('menuButton');
        const menuClose = document.getElementById('menuClose');
        const navPanel = document.getElementById('siteNavPanel');
        const navOverlay = document.getElementById('navOverlay');

        function openNav() {
            if (!navPanel || !navOverlay || !menuButton) return;
            navPanel.hidden = false;
            navOverlay.hidden = false;
            // force reflow so transition runs
            void navPanel.offsetWidth;
            navPanel.classList.add('is-open');
            navOverlay.classList.add('is-open');
            document.body.classList.add('nav-open');
            menuButton.setAttribute('aria-expanded', 'true');
            menuButton.setAttribute('aria-label', 'Close menu');
        }

        function closeNav() {
            if (!navPanel || !navOverlay || !menuButton) return;
            navPanel.classList.remove('is-open');
            navOverlay.classList.remove('is-open');
            document.body.classList.remove('nav-open');
            menuButton.setAttribute('aria-expanded', 'false');
            menuButton.setAttribute('aria-label', 'Open menu');
            window.setTimeout(function () {
                if (!navPanel.classList.contains('is-open')) {
                    navPanel.hidden = true;
                    navOverlay.hidden = true;
                }
            }, 350);
        }

        function toggleNav() {
            if (navPanel && navPanel.classList.contains('is-open')) closeNav();
            else openNav();
        }

        if (menuButton) menuButton.addEventListener('click', toggleNav);
        if (menuClose) menuClose.addEventListener('click', closeNav);
        if (navOverlay) navOverlay.addEventListener('click', closeNav);
        if (navPanel) {
            navPanel.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeNav);
            });
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeNav();
        });

        /* Transparent topbar + header become solid after a short scroll */
        if (header && document.body.classList.contains('page-home')) {
            const topbar = document.getElementById('siteTopbar');
            const scrim = header.querySelector('.header-scrim');
            const onScroll = () => {
                const solid = window.scrollY > 24;
                header.classList.toggle('is-solid', solid);
                if (topbar) topbar.classList.toggle('is-solid', solid);
                if (scrim) scrim.classList.toggle('is-solid', solid);
            };
            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
        }
    })();
    </script>
    @stack('scripts')
</body>
</html>
