(function (Drupal, once) {
  Drupal.behaviors.hakuExternalLinks = {
    attach(context) {
      once('haku-external-links', 'a[href]', context).forEach(function (a) {
        const href = a.getAttribute('href');
        if (!href) return;

        const target = (a.getAttribute('target') || '').toLowerCase();
        if (target === '_blank') {
          return;
        }

        if (
          href.startsWith('#') ||
          href.startsWith('mailto:') ||
          href.startsWith('tel:')
        )
          return;

        try {
          const url = new URL(href, window.location.origin);
          if (url.hostname !== window.location.hostname) {
            a.classList.add('is-external');
            // Open external links in new tab and add rel
            if (!a.getAttribute('target')) {
              a.setAttribute('target', '_blank');
            }
            let rel = a.getAttribute('rel') || '';
            if (!/noopener/i.test(rel)) {
              rel = `${rel} noopener noreferrer`.trim();
              a.setAttribute('rel', rel);
            }
          }
        } catch (e) {
          // Invalid URL
        }
      });
    },
  };
})(Drupal, once);
