<section data-bg="dark" class="section theme_on-dark">
    <div class="container">
        <div class="{{ request()->routeIs('home') ? 'footer-w' : '' }}">
            <a href="#hero" class="footer-s_s-top w-inline-block">
                <div class="l2">To top</div>
                <div class="s-down_arrow w-embed">
                    <svg width="100%" height="100%" viewBox="0 0 48 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40.6345 9C40.8959 8.45299 41.1486 7.97436 41.3926 7.56411C41.6541 7.15385 41.9068 6.81197 42.1508 6.53846L2.99981 6.53846L2.99981 5.46154L42.1508 5.46154C41.9068 5.17094 41.6541 4.82051 41.3926 4.41026C41.1486 4 40.8959 3.52992 40.6345 3L41.5495 3C42.6475 4.24787 43.7979 5.17094 45.0005 5.76923L45.0005 6.23077C43.7979 6.81197 42.6475 7.73504 41.5495 9L40.6345 9Z"
                        fill="currentColor"></path>
                    </svg>
                </div>
            </a>

            <div class="{{ request()->routeIs('home') ? 'footer-s' : 'footer-others' }}">
                <div class="footer-s_t"></div>
                <div class="{{ request()->routeIs('home') ? 'u-48' : '' }}"></div>
                <div class="footer-s_c">
                    <div class="grid">
                        <div class="footer-s_contact">                            
                            <div class="contact-cms w-dyn-list">
                                <div role="list" class="contact-cms_list w-dyn-items">
                                    <div role="listitem" class="contact-cms_list_item w-dyn-item">
                                        <a href="tel:+919824538519" target="_blank" class="nav-item w-inline-block">
                                            <div class="h3 a-center">+91-{{ setting('phone') }}</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="u-48"></div>
                        </div>
                        <div class="footer-s_address">
                            <div class="loc-cms w-dyn-list">
                                <div class="loc-cms_list w-dyn-items">
                                    <div class="loc-cms_list_item w-dyn-item">
                                        <h3 class="l1 reg a-center">Corporate Office</h3>
                                        <div class="u-16"></div>
                                        <h3 class="h5 a-center">{{ setting('company_name') }}</h3>
                                        <div class="u-16"></div>
                                        <p class="l1 reg a-center">{{ setting('address_line1') }}<br />{{ setting('address_line2') }}</p>
                                        <div class="u-8"></div>
                                        <p class="l1 reg a-center">Email: {{ setting('email') }}, Mobile: +91-{{ setting('mobile') }}</p>
                                        <!-- <div class="u-32"></div>
                                        <h3 class="l1 reg a-center">Foreign Subsidary Office</h3>
                                        <div class="u-8"></div>
                                        <p class="l1 reg a-center">{{ setting('foreign_office') }}</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-s_b">
                    <div class="grid">
                        <div class="footer-s_info">
                            <div data-text="p" class="l1">{{ setting('company_name') }}</div>
                            <div data-text="p" class="l1 reg no-wrap">© 2026 All rights reserved</div>                            
                        </div>
                        <div class="footer-s_credits">
                            <div hover-nav-item-trigger="" class="credits">                                
                                <div data-text="p" class="l1 reg a-right">
                                    Made by:<br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="u-48"></div>
    </div>    
</section>