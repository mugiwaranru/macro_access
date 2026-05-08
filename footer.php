<footer class="footer">
    <div class="footer-content">
        MACRO ACCESS DRUG TESTING CENTER <br>
        SINCE 2004
    </div>
</footer>

<style>
/* Reset some body/html defaults to ensure footer stays at bottom */
html, body {
    height: 100%;
    margin: 0;
}

body {
    display: flex;
    flex-direction: column;
}

/* Push the main content area to take up all available space */
main, .main-content, .dashboard-main, .analytics-wrapper, .centered-container, .landing-hero {
    flex: 1 0 auto;
}

.footer {
    flex-shrink: 0;
    width: 100%;
    background-color: #1e3a8a; /* Deep blue from design */
    color: rgba(255, 255, 255, 0.8);
    text-align: center;
    padding: 20px 0;
    font-size: 11px;
    line-height: 1.5;
    letter-spacing: 1px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
}
</style>