# WPCoderScan: pokaz działania

To repozytorium pokazuje, jak [WPCoderScan](https://github.com/wpcoder23/wpcoderscan) działa w GitHub Actions. Zawiera jedną, **celowo podatną** wtyczkę WordPress w katalogu `demo-plugin`. Nie instaluj jej na żadnej stronie.

Przy każdym pushu workflow skanuje kod i wysyła wyniki do zakładki **Security > Code scanning**. Zobaczysz tam znaleziska z miejscem w kodzie, poziomem ważności i opisem.

## Co jest w pokazie

- wstrzyknięcie SQL w zapytaniu `$wpdb`
- odbity XSS w trzech kontekstach HTML: w treści, w atrybucie i w adresie
- `unserialize` na danych z formularza
- trasa REST bez `permission_callback`
- `register_setting` bez `sanitize_callback`

## Spróbuj lokalnie

```bash
git clone https://github.com/wpcoder23/wpcoderscan-demo.git
cd wpcoderscan-demo
npx github:wpcoder23/wpcoderscan ./demo-plugin --suggest --patch naprawy.patch
git apply --check naprawy.patch && git apply naprawy.patch
```

Skaner pokaże gotowe poprawki dla XSS i `unserialize`. Łatka dobiera `esc_html()`, `esc_attr()` albo `esc_url()` do miejsca w HTML.

## Licencja

GPL-2.0-or-later, jak wtyczki WordPress.
