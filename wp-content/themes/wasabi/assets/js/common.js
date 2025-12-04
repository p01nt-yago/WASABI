window.addEventListener('load', () => {
    /**
     * header ハンバーガーメニュー
     */
    // let headerDOM = document.querySelector('.header');
    // let headerHamburgerOpenDOM = document.querySelector('.header_squareBtn_link_btn.-open');
    // let headerHamburgerCloseDOM = document.querySelector('.header_squareBtn_link_btn.-close');
    // let headerHamburgerMenuWrapDOM = document.querySelector('.header_hamburgerMenu_wrap');
    // let headerLinkDOMs = document.querySelectorAll('.header a');
    
    // headerHamburgerOpenDOM.addEventListener('click', () => {
    //     headerDOM.classList.add('is_active');
    //     gsap.to(headerHamburgerMenuWrapDOM, .2, { autoAlpha: 1 });
    // });
    // headerHamburgerCloseDOM.addEventListener('click', () => {
    //     headerDOM.classList.remove('is_active');
    //     gsap.to(headerHamburgerMenuWrapDOM, .2, { autoAlpha: 0 });
    // });
    // headerLinkDOMs.forEach(headerLinkDOM => {
    //     headerLinkDOM.addEventListener('click', () => {
    //         headerDOM.classList.remove('is_active');
    //         gsap.to(headerHamburgerMenuWrapDOM, .2, { autoAlpha: 0 });
    //     });
    // })

    /**
     * スムーススクロール
     */
    let smoothScrollTriggers = document.querySelectorAll('a[href^="#"]');
    let headerH = document.querySelector('.header_container').clientHeight;
    let gap = headerH + 100;
    for( let smoothScrollTrigger of smoothScrollTriggers ) {
        smoothScrollTrigger.addEventListener('click', (event) => {
            event.preventDefault();
            let href = smoothScrollTrigger.getAttribute('href');
            let pos;
            
            if( href == '#' ){
                pos = 0;
            }else{
                let targetElement = document.querySelector(`#${href.replace('#', '')}`);
                let rect = targetElement.getBoundingClientRect().top;
                let offset = window.pageYOffset;
                pos = rect + offset - gap;
            }

            window.scrollTo({
                top: pos,
                behavior: 'smooth',
            });
        });
    }

    /**
     * ハッシュ付きURLの時にページ内遷移させる
     */
    // let hash = window.location.hash;
    // if (hash) {
    //     let target = document.querySelector(hash);
    //     if (target) {
    //         setTimeout(() => {
    //             let rect = target.getBoundingClientRect().top;
    //             let offset = window.pageYOffset;
    //             let pos = rect + offset - gap;

    //             window.scrollTo({
    //                 top: pos,
    //                 behavior: 'smooth'
    //             });
    //         }, 100);
    //     }
    // }

    /**
     * リンクを設定(aタグを使うと自動で閉じタグが生成されるため)
     */
    document.addEventListener('click', (event) => {
        const target = event.target.closest('[data-link]');
        if (!target) return; // data-link を持つ要素でなければ終了

        event.preventDefault();
        event.stopPropagation();

        location.href = target.dataset.link;
    });

    /**
     * 全ページ共通アニメーション
     */
    // フェードイン(下から)    
    gsap.registerEffect({
        name: 'fadeUp',
        defaults: { y: 50, },
        effect: (targets, config) => {
            return gsap.fromTo(targets, .7,
                { y: config.y, autoAlpha: 0, },
                {
                    y: 0, autoAlpha: 1,
                    scrollTrigger: { trigger: targets, start: 'top 90%', }
                }
            );
        },
        extendTimeline: true,
    });

    let fadeUpAnimDOMs = [ ...document.querySelectorAll('.js-fadeUpAnim') ];
    fadeUpAnimDOMs.forEach((fadeUpAnimDOM) => {
        gsap.effects.fadeUp(fadeUpAnimDOM); 
    });

    // /page-templates/page-title.php アニメーション
    // let pageTitleAnimDOMs = [ ...document.querySelectorAll('.page_title_en') ];
    // pageTitleAnimDOMs.forEach((pageTitleAnimDOM) => {
    //     gsap.to(pageTitleAnimDOM, 1, {
    //         '--scaleX': 1,
    //         scrollTrigger: {
    //             trigger: pageTitleAnimDOM,
    //             start: 'top 90%'
    //         }
    //     });
    // });
});