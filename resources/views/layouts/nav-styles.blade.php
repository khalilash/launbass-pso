
<style>
    /* Using system SF stack: no external @import needed */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes popIn {
        0% { transform: scale(0.8); opacity: 0; }
        70% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    /* Shared bottom navigation styles used by layouts/navbar.blade.php */

    /* theme vars fallbacks */
    :root{
      --primary: #0d9488;
      --fab-blue: #14b8a6;
      --bg-main: #f5f5f5;
      --text-main: #111827;
      --text-muted: #6b7280;
    }

    /* ensure content isn't hidden behind the fixed nav */
    body { padding-bottom: 86px; }

    /* Global font family for all pages */
    html, body, button, input, select, textarea, a, p, span, div, h1, h2, h3, h4, h5, h6, small, strong, em, label {
        font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", "SF Pro Display", system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    }

    /* nav shell */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: calc(100% - 32px);
        max-width: 480px;
        margin: 0 auto;
        background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
        border-radius: 28px 28px 0 0;
        padding: 12px 26px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #ffffff;
        z-index: 999;
        box-shadow: 0 -10px 40px rgba(13, 148, 136, 0.3), 0 -2px 10px rgba(13, 148, 136, 0.2);
        animation: slideUp 0.5s ease-out forwards;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        will-change: transform;
    }

    /* nav items */
    .bottom-nav .nav-item {
        flex: 1;
        text-align: center;
        font-size: 10px;
        opacity: 0.6;
        background: transparent;
        border: none;
        color: #ffffff;
        padding: 0;
        margin: 0;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        position: relative;
    }

    .bottom-nav .nav-item:hover {
        opacity: 0.85;
    }

    .bottom-nav .nav-item:focus { outline: none; box-shadow: none; }

    /* icon wrapper */
    .bottom-nav .nav-icon-wrap {
        width: 40px;
        height: 40px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .bottom-nav .nav-item:hover .nav-icon-wrap {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
    }

    .bottom-nav .nav-icon-wrap i {
        font-size: 18px;
        color: inherit;
        transition: all 0.3s ease;
    }

    /* active state */
    .bottom-nav .nav-item.active {
        opacity: 1;
        font-weight: 600;
    }

    .bottom-nav .nav-item.active .nav-icon-wrap {
        background: linear-gradient(135deg, var(--fab-blue), #14b8a6);
        transform: translateY(-6px) scale(1.15);
        box-shadow: 0 8px 24px rgba(13, 148, 136, 0.4), 0 0 1px rgba(255, 255, 255, 0.5) inset;
        animation: popIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .bottom-nav .nav-item.active .nav-icon-wrap i {
        color: #ffffff;
        animation: float 2s ease-in-out infinite;
    }

    /* small underline for active */
    .bottom-nav .nav-item::after {
        content: "";
        display: block;
        width: 16px;
        height: 2px;
        margin: 2px auto 0;
        border-radius: 999px;
        background: transparent;
        transition: all 0.3s ease;
    }

    .bottom-nav .nav-item.active::after {
        background: #ffffff;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.5);
    }

    /* responsive tweak */
    @media (max-width:480px) {
      .bottom-nav {
        padding: 10px 18px 14px;
        border-radius: 24px 24px 0 0;
      }
      .bottom-nav .nav-icon-wrap {
        width: 36px;
        height: 36px;
      }
      .bottom-nav .nav-icon-wrap i {
        font-size: 16px;
      }
    }
</style>
