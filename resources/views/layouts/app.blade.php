<!DOCTYPE html>
<html lang="en" class="w-mod-js wf-ambroisefrancoisstd-n4-active wf-sloopscriptthree-n4-active wf-active lenis">
<head>
<meta charset="utf-8">
<title>Satyamev Group</title>  
<meta content="width=device-width, initial-scale=1" name="viewport">   
<link rel="stylesheet" href="{{ asset('css/styles.css') }}" type="text/css">
</head>
<body class="body">
<div data-barba="wrapper" class="transition-wrapper">

    @if (Route::currentRouteName() === 'home')
        <div class="landscape-cover">
            <div class="landscape-cover_img">
                <img loading="eager" src="images/landscape.svg" alt="" class="img contain">
            </div>
            <div class="landscape-cover_bg"></div>
        </div>

        @if(setting('preloader') == 1)
            <div data-preloader="" class="preloader theme_on-dark"     
                @if(setting('preloader') == 0)
                    style="--arch-y: -100vh; --arch-w: 125vw; display: none;"
                @endif
                >
                <div class="preloader_ctn" >
                    <div class="preloader_t">
                        <div class="u-48"></div>
                        <div class="s_logo">
                            <div data-part="ctn" class="logo_symbol ico-48">
                                <div class="logo w-embed">                                    
                                    <svg width="200%" height="200%" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1_2)">
                                            <path d="M11.2491 91.8397C10.7317 91.8671 10.3214 92.0679 10.0184 92.4421C9.71531 92.8163 9.54849 93.3355 9.5179 93.9996C9.49711 94.4508 9.54341 94.8347 9.6568 95.1513C9.76594 95.4678 9.92736 95.7141 10.1411 95.8903C10.355 96.0623 10.6024 96.1547 10.8834 96.1677C11.1171 96.187 11.3237 96.1474 11.5031 96.049C11.6827 95.9464 11.8408 95.8022 11.9773 95.6166C12.1096 95.4307 12.2284 95.2143 12.3336 94.9675C12.4345 94.7205 12.5235 94.4558 12.6005 94.1735L12.9356 93.0116C13.0896 92.4471 13.284 91.9313 13.5188 91.4644C13.7536 90.9974 14.0344 90.5965 14.3612 90.2618C14.688 89.927 15.0666 89.6736 15.4968 89.5014C15.9273 89.325 16.415 89.2473 16.9601 89.2681C17.7602 89.3092 18.4447 89.5455 19.0135 89.977C19.5782 90.404 20.0049 91.0038 20.2935 91.7764C20.5781 92.5446 20.6959 93.4608 20.6468 94.525C20.5982 95.5807 20.3941 96.4927 20.0345 97.2611C19.6751 98.0252 19.1682 98.6119 18.5137 99.0211C17.8552 99.4259 17.055 99.6172 16.1133 99.5952L16.2365 96.9198C16.6763 96.9102 17.0482 96.8015 17.3521 96.5936C17.652 96.3813 17.8851 96.0913 18.0513 95.7236C18.2135 95.3514 18.3056 94.9269 18.3275 94.4502C18.3491 93.9819 18.2997 93.5722 18.1794 93.2212C18.0592 92.8658 17.8822 92.5868 17.6484 92.384C17.4146 92.1813 17.1402 92.0727 16.8252 92.0582C16.5315 92.0447 16.2806 92.1205 16.0724 92.2859C15.8645 92.4469 15.6827 92.6902 15.5269 93.0158C15.3713 93.3371 15.2251 93.7335 15.0882 94.205L14.665 95.6124C14.3461 96.7026 13.8867 97.5538 13.2868 98.166C12.687 98.7783 11.904 99.06 10.9379 99.0113C10.146 98.979 9.46393 98.7365 8.89184 98.2835C8.31994 97.8263 7.88523 97.2155 7.58771 96.451C7.29018 95.6865 7.16338 94.8275 7.20731 93.8739C7.25202 92.9034 7.45706 92.0639 7.82243 91.3555C8.18799 90.6429 8.67594 90.098 9.28627 89.7209C9.8966 89.3437 10.5916 89.1667 11.3712 89.1898L11.2491 91.8397ZM21.9551 78.9568L21.145 81.81L9.78626 73.8869L10.7605 70.4558L24.5862 69.6903L23.7761 72.5435L13.1651 72.9393L13.1371 73.0377L21.9551 78.9568ZM16.9545 77.7297L18.8681 70.9904L20.9465 71.5805L19.0329 78.3198L16.9545 77.7297ZM17.023 58.4056L15.0351 57.2851L20.3144 47.9191L22.3023 49.0396L20.3343 52.531L29.7505 57.8385L28.4071 60.2218L18.991 54.9142L17.023 58.4056ZM26.007 38.7154L28.1121 36.4395L34.2778 38.0762L34.3646 37.9824L32.2527 31.9628L34.3577 29.6869L37.3285 38.9388L40.7259 42.0812L38.8596 44.099L35.4622 40.9566L26.007 38.7154ZM50.7624 32.4231L48.2871 34.0569L44.8475 20.6418L47.8243 18.677L58.8019 27.1167L56.3266 28.7505L48.0264 22.1279L47.9411 22.1843L50.7624 32.4231ZM47.7732 28.2307L53.6201 24.3715L54.8102 26.1747L48.9633 30.0338L47.7732 28.2307ZM61.9317 10.3218L65.1834 9.28382L71.2925 16.5664L71.4386 16.5197L72.1983 7.04451L75.45 6.00649L79.431 18.4774L76.8735 19.2938L74.2823 11.1768L74.1788 11.2098L73.5232 20.2962L71.7816 20.8522L65.9729 13.7958L65.8693 13.8288L68.4702 21.9763L65.9127 22.7927L61.9317 10.3218ZM88.0904 16.0169L87.4123 2.94356L96.2214 2.4866L96.3396 4.7655L90.2945 5.07907L90.4561 8.1942L96.048 7.90414L96.1662 10.183L90.5743 10.4731L90.7362 13.5946L96.8069 13.2797L96.9251 15.5586L88.0904 16.0169ZM110.612 2.93288L111.886 13.292L112.006 13.3144L116.957 4.12428L119.973 4.69049L113.122 16.7238L109.616 16.0655L107.59 2.36549L110.612 2.93288ZM147.931 20.9604C148.027 20.6513 148.073 20.3525 148.068 20.0641C148.066 19.7722 148.013 19.4925 147.908 19.2249C147.809 18.9562 147.659 18.7026 147.459 18.4641C147.262 18.2279 147.014 18.0117 146.715 17.8153C146.156 17.4482 145.573 17.2645 144.967 17.2641C144.364 17.2661 143.771 17.4554 143.187 17.8319C142.606 18.2049 142.065 18.7725 141.565 19.5349C141.065 20.2974 140.755 21.0218 140.636 21.7081C140.517 22.3945 140.577 23.0175 140.816 23.5772C141.057 24.1333 141.467 24.6008 142.044 24.9795C142.568 25.3232 143.076 25.524 143.568 25.582C144.066 25.6386 144.525 25.5603 144.945 25.3468C145.369 25.1358 145.734 24.7969 146.041 24.3302L146.465 24.7083L143.644 22.8565L144.787 21.1143L149.367 24.12L148.462 25.4987C147.831 26.4606 147.085 27.1539 146.225 27.5785C145.368 27.9996 144.46 28.1633 143.502 28.0698C142.547 27.9727 141.609 27.6225 140.69 27.0193C139.664 26.3459 138.911 25.5281 138.431 24.566C137.954 23.6003 137.773 22.5562 137.887 21.4337C138.008 20.31 138.447 19.171 139.205 18.0167C139.787 17.1296 140.434 16.4229 141.147 15.8965C141.865 15.3689 142.617 15.016 143.401 14.8377C144.186 14.6595 144.971 14.6473 145.757 14.8012C146.543 14.9551 147.298 15.2693 148.021 15.744C148.641 16.1508 149.158 16.6204 149.574 17.1528C149.991 17.6817 150.299 18.2456 150.497 18.8446C150.699 19.4459 150.783 20.0593 150.75 20.6848C150.719 21.3067 150.563 21.9129 150.282 22.5036L147.931 20.9604ZM152.753 35.0494L162.357 26.1528L165.867 29.9416C166.539 30.6668 166.982 31.406 167.198 32.159C167.419 32.9123 167.419 33.642 167.196 34.3481C166.979 35.0545 166.553 35.7016 165.918 36.2895C165.281 36.8803 164.604 37.251 163.89 37.4016C163.179 37.5494 162.46 37.4751 161.732 37.179C161.007 36.886 160.303 36.3706 159.62 35.6328L157.27 33.096L158.902 31.5843L160.948 33.7928C161.307 34.1805 161.658 34.4532 162.002 34.6111C162.346 34.769 162.682 34.812 163.01 34.7401C163.342 34.6713 163.665 34.4907 163.981 34.1982C164.3 33.9028 164.509 33.5896 164.609 33.2588C164.712 32.931 164.7 32.5853 164.572 32.2215C164.45 31.858 164.208 31.4809 163.846 31.0902L162.578 29.7209L154.634 37.0798L152.753 35.0494ZM161.928 36.1869L159.769 42.6223L157.693 40.3809L159.9 33.9971L161.928 36.1869ZM176.683 56.2842C175.43 56.9685 174.234 57.3131 173.096 57.3182C171.96 57.327 170.937 57.0503 170.028 56.4883C169.125 55.928 168.396 55.1411 167.843 54.1276C167.285 53.1066 167.016 52.0637 167.037 50.9988C167.057 49.934 167.378 48.9259 168 47.9747C168.622 47.0234 169.557 46.2067 170.806 45.5245C172.059 44.8402 173.253 44.4937 174.39 44.4849C175.526 44.4761 176.546 44.7519 177.449 45.3122C178.356 45.8705 179.088 46.6601 179.646 47.6811C180.199 48.6946 180.466 49.7338 180.445 50.7986C180.431 51.8652 180.113 52.8741 179.491 53.8253C178.872 54.7803 177.935 55.5999 176.683 56.2842ZM175.337 53.8215C176.149 53.3782 176.767 52.8829 177.192 52.3354C177.618 51.7917 177.856 51.2224 177.905 50.6276C177.954 50.0327 177.818 49.4417 177.497 48.8546C177.177 48.2674 176.753 47.8337 176.226 47.5534C175.699 47.2731 175.09 47.1636 174.4 47.2248C173.712 47.2898 172.963 47.544 172.151 47.9872C171.339 48.4304 170.72 48.9239 170.294 49.4676C169.869 50.0151 169.633 50.5862 169.584 51.1811C169.535 51.7759 169.671 52.3669 169.991 52.9541C170.312 53.5413 170.736 53.975 171.263 54.2553C171.79 54.5356 172.397 54.6432 173.085 54.5782C173.775 54.517 174.526 54.2647 175.337 53.8215ZM189.551 71.971L190.217 74.6573L181.966 76.7042C181.039 76.9341 180.174 76.9139 179.369 76.6437C178.566 76.3777 177.871 75.8979 177.287 75.2044C176.706 74.5098 176.285 73.6373 176.025 72.5867C175.763 71.532 175.727 70.562 175.915 69.6766C176.108 68.7902 176.498 68.0416 177.084 67.4308C177.67 66.82 178.426 66.3997 179.353 66.1698L187.604 64.1229L188.27 66.8092L180.248 68.7992C179.765 68.9193 179.361 69.1315 179.037 69.4358C178.714 69.7442 178.493 70.1195 178.374 70.5616C178.255 71.0038 178.26 71.4833 178.389 72.0003C178.518 72.5215 178.738 72.9477 179.048 73.279C179.36 73.6144 179.73 73.8409 180.158 73.9585C180.588 74.0802 181.045 74.081 181.529 73.961L189.551 71.971ZM179.471 86.6362L192.548 86.0436L192.782 91.203C192.827 92.1949 192.676 93.0485 192.329 93.7638C191.986 94.479 191.488 95.0347 190.836 95.4311C190.189 95.8316 189.431 96.0515 188.563 96.0908C187.694 96.1302 186.92 95.9776 186.239 95.6331C185.557 95.2885 185.016 94.7692 184.613 94.0751C184.211 93.3852 183.987 92.5379 183.941 91.5333L183.792 88.2448L186.008 88.1444L186.137 90.9859C186.161 91.518 186.272 91.9523 186.471 92.2889C186.674 92.6294 186.943 92.8775 187.279 93.0329C187.619 93.1924 188.004 93.2624 188.434 93.2429C188.868 93.2232 189.243 93.1188 189.558 92.9296C189.879 92.7444 190.12 92.4733 190.283 92.1161C190.45 91.7587 190.522 91.3119 190.497 90.7755L190.413 88.9109L179.596 89.4011L179.471 86.6362Z" fill="white"/>
                                            <path d="M103.822 51.6085L149.246 97.3712H131.619L103.822 69.9136L81.449 92.6254H116.703L109.246 100.083H55.3474L103.822 51.6085Z" fill="white"/>
                                            <path d="M139.754 103.812L121.788 103.812L94.6693 130.592L66.8727 103.812L49.2457 103.812L94.6693 148.897L139.754 103.812Z" fill="white"/>
                                            <path d="M39.9943 165.304C40.2886 164.878 40.38 164.43 40.2686 163.962C40.1572 163.493 39.8479 163.044 39.3406 162.615C38.9959 162.323 38.6636 162.125 38.3436 162.022C38.0264 161.915 37.7327 161.892 37.4627 161.954C37.1959 162.018 36.9716 162.158 36.7898 162.373C36.6319 162.546 36.5371 162.734 36.5054 162.936C36.4771 163.141 36.4947 163.354 36.5584 163.575C36.6249 163.794 36.7237 164.02 36.855 164.254C36.989 164.485 37.1443 164.717 37.3208 164.95L38.0365 165.925C38.3897 166.391 38.6795 166.86 38.9059 167.331C39.1324 167.802 39.2785 168.269 39.344 168.733C39.4096 169.196 39.3793 169.65 39.2529 170.096C39.1298 170.545 38.8937 170.979 38.5444 171.398C38.0233 172.006 37.4183 172.404 36.7293 172.591C36.0463 172.778 35.3108 172.749 34.5227 172.506C33.7406 172.263 32.943 171.797 32.1301 171.108C31.3237 170.425 30.7259 169.707 30.3369 168.953C29.9512 168.202 29.796 167.442 29.8715 166.674C29.9529 165.905 30.2899 165.154 30.8823 164.422L32.926 166.153C32.6651 166.507 32.5241 166.868 32.5032 167.236C32.4883 167.603 32.5757 167.964 32.7654 168.321C32.9612 168.676 33.2412 169.008 33.6054 169.317C33.963 169.62 34.3176 169.831 34.6692 169.95C35.0239 170.072 35.353 170.102 35.6563 170.04C35.9596 169.979 36.2132 169.828 36.417 169.587C36.607 169.363 36.7001 169.118 36.6962 168.852C36.6956 168.589 36.6139 168.297 36.4512 167.975C36.2917 167.655 36.067 167.297 35.7772 166.901L34.9208 165.707C34.2522 164.788 33.8585 163.905 33.7398 163.056C33.6211 162.207 33.8759 161.415 34.5044 160.68C35.0134 160.072 35.6219 159.68 36.3299 159.503C37.0412 159.33 37.7904 159.358 38.5775 159.589C39.3646 159.82 40.1224 160.244 40.8508 160.861C41.5922 161.489 42.1319 162.164 42.4698 162.886C42.811 163.611 42.9447 164.33 42.8708 165.043C42.7969 165.757 42.5128 166.416 42.0185 167.019L39.9943 165.304ZM51.7208 169.746L44.7799 180.845L42.4333 179.378L49.3741 168.279L51.7208 169.746ZM67.3317 177.478L62.2027 189.522L60.0032 188.585L57.9914 178.773L57.9032 178.736L54.675 186.316L52.1286 185.232L57.2575 173.188L59.4923 174.139L61.4655 183.928L61.5713 183.973L64.797 176.398L67.3317 177.478ZM83.1772 186.668L80.4356 186.101C80.4589 185.736 80.4218 185.4 80.3244 185.092C80.2279 184.781 80.0788 184.502 79.8774 184.256C79.6759 184.009 79.4274 183.801 79.1319 183.631C78.8405 183.462 78.5112 183.34 78.144 183.264C77.4805 183.126 76.8684 183.172 76.3078 183.4C75.748 183.623 75.2678 184.02 74.867 184.59C74.4671 185.155 74.1752 185.883 73.9913 186.771C73.8022 187.685 73.779 188.481 73.9216 189.159C74.0683 189.838 74.3551 190.387 74.7819 190.806C75.2087 191.225 75.7455 191.501 76.3923 191.635C76.7554 191.71 77.1012 191.732 77.4299 191.7C77.7627 191.668 78.0691 191.586 78.3492 191.452C78.63 191.315 78.8774 191.129 79.0912 190.895C79.3092 190.661 79.4849 190.38 79.6183 190.051L82.3574 190.63C82.1647 191.204 81.8699 191.735 81.4731 192.223C81.0812 192.707 80.603 193.116 80.0383 193.447C79.4787 193.775 78.8454 193.996 78.1385 194.111C77.4365 194.223 76.6745 194.193 75.8525 194.023C74.7091 193.787 73.7402 193.317 72.9459 192.613C72.1558 191.91 71.6014 191.014 71.2826 189.925C70.9681 188.837 70.955 187.597 71.2434 186.203C71.5326 184.805 72.0416 183.67 72.7703 182.798C73.499 181.926 74.3671 181.327 75.3747 181C76.3831 180.669 77.4507 180.62 78.5774 180.853C79.3202 181.007 79.9871 181.254 80.5783 181.594C81.1736 181.935 81.676 182.356 82.0855 182.859C82.4959 183.357 82.7959 183.926 82.9855 184.566C83.1794 185.206 83.2433 185.907 83.1772 186.668ZM89.559 196.462L89.7929 183.373L98.6126 183.53L98.5718 185.812L92.5195 185.704L92.4637 188.823L98.0623 188.923L98.0215 191.204L92.4229 191.104L92.3671 194.229L98.4449 194.338L98.4042 196.62L89.559 196.462ZM119.459 181.168L122.656 193.863L119.972 194.539L117.416 184.392L117.342 184.411L114.894 186.965L114.294 184.585L116.936 181.804L119.459 181.168ZM130.712 177.347C131.328 177.076 131.967 176.919 132.627 176.876C133.292 176.831 133.948 176.936 134.595 177.192C135.246 177.446 135.867 177.89 136.457 178.525C137.05 179.153 137.586 180.009 138.066 181.092C138.513 182.111 138.797 183.071 138.918 183.972C139.041 184.867 139.012 185.687 138.832 186.432C138.651 187.176 138.325 187.827 137.852 188.383C137.378 188.936 136.77 189.375 136.029 189.7C135.229 190.051 134.455 190.207 133.707 190.168C132.958 190.124 132.278 189.918 131.669 189.547C131.062 189.172 130.572 188.665 130.2 188.028L132.699 186.932C132.988 187.326 133.342 187.575 133.76 187.68C134.177 187.781 134.616 187.731 135.076 187.529C135.856 187.186 136.301 186.586 136.408 185.729C136.514 184.868 136.309 183.844 135.792 182.656L135.71 182.692C135.685 183.122 135.576 183.53 135.383 183.918C135.188 184.301 134.924 184.647 134.589 184.957C134.259 185.265 133.874 185.515 133.433 185.709C132.726 186.019 132.023 186.13 131.324 186.041C130.624 185.953 129.987 185.688 129.412 185.247C128.836 184.806 128.385 184.213 128.058 183.468C127.701 182.666 127.572 181.868 127.671 181.075C127.77 180.283 128.077 179.562 128.593 178.912C129.11 178.257 129.816 177.735 130.712 177.347ZM131.603 179.329C131.209 179.502 130.899 179.75 130.673 180.072C130.45 180.393 130.319 180.751 130.278 181.146C130.241 181.539 130.31 181.93 130.486 182.318C130.659 182.713 130.9 183.03 131.211 183.271C131.523 183.506 131.871 183.651 132.254 183.706C132.638 183.756 133.026 183.696 133.416 183.524C133.709 183.396 133.956 183.222 134.158 183.003C134.36 182.784 134.51 182.539 134.61 182.267C134.711 181.99 134.759 181.702 134.753 181.402C134.747 181.102 134.682 180.809 134.557 180.525C134.387 180.148 134.145 179.84 133.83 179.601C133.516 179.362 133.163 179.214 132.771 179.159C132.378 179.103 131.989 179.159 131.603 179.329ZM144.729 170.291C145.287 169.914 145.887 169.645 146.529 169.483C147.174 169.319 147.838 169.305 148.521 169.44C149.208 169.573 149.898 169.898 150.593 170.416C151.289 170.928 151.971 171.673 152.638 172.652C153.261 173.573 153.713 174.466 153.994 175.331C154.276 176.189 154.396 177.001 154.352 177.766C154.309 178.531 154.105 179.23 153.74 179.862C153.373 180.491 152.854 181.032 152.184 181.486C151.46 181.975 150.727 182.268 149.984 182.363C149.239 182.456 148.533 182.375 147.867 182.12C147.203 181.86 146.63 181.45 146.149 180.891L148.409 179.362C148.765 179.697 149.158 179.879 149.589 179.907C150.017 179.931 150.439 179.803 150.855 179.521C151.561 179.044 151.89 178.374 151.842 177.511C151.791 176.645 151.405 175.675 150.683 174.599L150.609 174.649C150.661 175.077 150.627 175.498 150.507 175.914C150.385 176.326 150.187 176.714 149.914 177.079C149.644 177.441 149.31 177.757 148.911 178.027C148.272 178.459 147.601 178.695 146.897 178.733C146.192 178.772 145.518 178.627 144.873 178.297C144.228 177.966 143.677 177.464 143.221 176.79C142.726 176.065 142.455 175.304 142.41 174.506C142.365 173.709 142.537 172.944 142.927 172.212C143.318 171.475 143.919 170.834 144.729 170.291ZM145.963 172.081C145.606 172.322 145.346 172.621 145.182 172.979C145.021 173.335 144.956 173.711 144.987 174.106C145.021 174.5 145.16 174.872 145.402 175.222C145.643 175.579 145.938 175.848 146.287 176.029C146.636 176.204 147.005 176.284 147.391 176.269C147.779 176.249 148.149 176.12 148.502 175.881C148.767 175.702 148.978 175.487 149.138 175.235C149.297 174.983 149.401 174.715 149.45 174.43C149.5 174.139 149.495 173.846 149.435 173.552C149.375 173.258 149.258 172.983 149.084 172.725C148.849 172.385 148.555 172.126 148.203 171.947C147.851 171.769 147.477 171.687 147.081 171.703C146.685 171.718 146.312 171.844 145.963 172.081ZM163.281 173.495L160.087 161.895L160.027 161.829L155.344 166.076L153.824 164.4L160.628 158.229L162.169 159.929L165.397 171.576L163.281 173.495Z" fill="white"/>
                                            <circle cx="15" cy="138" r="3" fill="white"/>
                                            <circle cx="183" cy="138" r="3" fill="white"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1_2">
                                            <rect width="200" height="200" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="preloader_c">
                        <div class="grid">
                            <div class="preloader_title-l">
                                <div data-part="h" class="c1 a-center">{{ setting('preloader_line1') }}</div>
                            </div>
                            <div class="preloader_logo">                    
                                <div class="preloader_logo_a">
                                    <div data-part="a" class="a2 preloader_a a-center">{{ setting('company_name') }}</div>
                                </div>
                            </div>
                            <div class="preloader_title-r">
                                <div data-part="h" class="c1 a-center" >
                                    <span class="split-word" >
                                        <span class="split-char">{{ setting('preloader_line2') }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="preloader_b">
                        <div class="grid">
                            <div class="s_title">
                                <div data-part="line" class="preloader_progress">
                                    <div class="preloader_progress_fill">
                                        <div class="preloader_progress_track"></div>
                                    </div>
                                </div>
                                <div class="u-32"></div>
                                <p data-part="p" class="l1 a-center">Since {{ setting('since') }}</p>
                            </div>
                        </div>
                        <div class="u-48"></div>
                    </div>
                </div>
                <div class="preloader_bg_arch">
                    <div class="preloader_bg_arch_is-1"></div>
                    <div class="preloader_bg_arch_is-2"></div>
                </div>
                <div class="preloader_bg">
                    <div class="preloader_bg_a">
                        <img src="images/preloader_bg.svg" loading="eager" alt="" class="img">
                    </div>
                    <div class="preloader_bg_decor">
                        <div data-wf--decor--variant="large" class="decor">
                            <div class="frame_l-tb w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                            <div class="frame_lt w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                            <div class="frame_t-lr w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                            <div class="frame_rt w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                            <div class="frame_r-tb w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                            <div class="frame_rb w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                            <div class="frame_b-lr w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                            <div class="frame_lb w-embed">
                                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(setting('cookies') == 1)
            <div data-cookies="" class="cookies" >
                <div class="cookies_c">
                    <div class="grid">
                        <div id="w-node-a93c3093-e77a-7926-27af-e0a2d9898e16-d9898e13" class="cookies_card">
                            <div class="cookies_card_t">
                                <div class="l1 reg b-mob">Cookies</div>
                                <div class="cookies_card_title b-desk">
                                    <div class="a1 a-center">Cookies</div>
                                </div>
                            </div>
                            <div class="cookies_card_b">
                                <div class="l1 a-center mob_a-left">This website uses cookies to ensure you get the best experience on website.</div>
                                <div class="u-12"></div>
                                <div class="cookies_card_btn-list">
                                    <a data-cookies="accept"  hover-link="" href="#" class="link w-inline-block">
                                        <div class="link_label">
                                            <div class="link_label_text">
                                                <div hover="text" class="h6">Accept</div>
                                            </div>
                                            <div class="link_label_text is-2">
                                                <div hover="text" class="h6">Accept</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="h6">/</div>
                                    <a data-cookies="decline"  hover-link="" href="#" class="link w-inline-block">
                                        <div class="link_label">
                                            <div class="link_label_text">
                                                <div hover="text" class="h6">Decline</div>
                                            </div>
                                            <div class="link_label_text is-2">
                                                <div hover="text" class="h6">Decline</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card_decor">
                                <div data-wf--decor--variant="med" class="decor">
                                    <div class="frame_l-tb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_lt w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_t-lr w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_rt w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_r-tb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_rb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_b-lr w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_lb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- @if (!request()->cookie('cookie_consent'))
            <div class="cookies" id="cookie-consent">
                <div class="cookies_c">
                    <div class="grid">
                        <div id="w-node-a93c3093-e77a-7926-27af-e0a2d9898e16-d9898e13" class="cookies_card">
                            <div class="cookies_card_t">
                                <div class="l1 reg b-mob">1Cookies</div>
                                <div class="cookies_card_title b-desk">
                                    <div class="a1 a-center">Cookies</div>
                                </div>
                            </div>
                            <div class="cookies_card_b">
                                <div class="l1 a-center mob_a-left">This website uses cookies to ensure you get the best experience on website.</div>
                                <div class="u-24"></div>
                                <div class="cookies_card_btn-list">
                                    <a data-cookies="accept"  hover-link="" href="#" class="link w-inline-block">
                                        <div class="link_label">
                                            <div class="link_label_text">
                                                <div hover="text" class="h6" >
                                                    <span class="split-line" >
                                                        <span class="split-word" >
                                                            <span class="split-char" >A</span>
                                                            <span class="split-char" >c</span>
                                                            <span class="split-char" >c</span>
                                                            <span class="split-char" >e</span>
                                                            <span class="split-char" >p</span>
                                                            <span class="split-char" >t</span>
                                                        </span>
                                                        <span class="link_line" ></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="link_label_text is-2">
                                                <div hover="text" class="h6" >
                                                    <span class="split-word" >
                                                        <span class="split-char"  >A</span>
                                                        <span class="split-char"  >c</span>
                                                        <span class="split-char"  >c</span>
                                                        <span class="split-char"  >e</span>
                                                        <span class="split-char" >p</span>
                                                        <span class="split-char"  >t</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="h6">/</div>
                                    <a data-cookies="decline"  hover-link="" href="#" class="link w-inline-block">
                                        <div class="link_label">
                                            <div class="link_label_text">
                                                <div hover="text" class="h6" >
                                                    <span class="split-line"  ><span class="split-word" ><span class="split-char" >D</span><span class="split-char" >e</span>
                                                    <span
                                                    class="split-char" >c</span>
                                                    <span class="split-char" >l</span><span class="split-char" >i</span><span class="split-char" >n</span><span class="split-char" >e</span></span>
                                                        <span
                                                        class="link_line" ></span>
                                                            </span>
                                                </div>
                                            </div>
                                            <div class="link_label_text is-2">
                                                <div hover="text" class="h6" ><span class="split-word" ><span class="split-char"  >D</span>
                                                    <span
                                                    class="split-char"  >e</span><span class="split-char"  >c</span><span class="split-char"
                                                        >l</span><span class="split-char" 
                                                        >i</span><span class="split-char"  >n</span>
                                                        <span
                                                        class="split-char"  >e</span>
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card_decor">
                                <div data-wf--decor--variant="med" class="decor">
                                    <div class="frame_l-tb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_lt w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_t-lr w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_rt w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_r-tb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="50%" y1="0%" x2="50%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_rb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="100%" x2="100%" y2="0%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_b-lr w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="50%" x2="100%" y2="50%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                    <div class="frame_lb w-variant-db77920b-274b-9558-1ced-34e87f5b7d94 w-embed">
                                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0%" y1="0%" x2="100%" y2="100%" stroke-width="1" stroke="currentColor" vector-effect="non-scaling-stroke"></line>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif -->
    @endif
    
    @include('layouts.header')        
    @yield('content')        
    @include('layouts.footer')    
</div>

<script src="{{ asset('js/jquery-3.5.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/core.js') }}"></script>
<script src="{{ asset('js/gsap.min.js') }}"></script>
<script src="{{ asset('js/scrollTrigger.min.js') }}"></script>
<script src="{{ asset('js/splitText.min.js') }}"></script>
<script src="{{ asset('js/customEase.min.js') }}"></script>
<script src="{{ asset('js/lenis.min.js') }}"></script>
<script src="{{ asset('js/effects2.js') }}"></script>
<script src="{{ asset('js/documentReady.js') }}"></script>

@yield('customJs')

</body>
</html>