# Immobilien Suchauftrag Funnel

**Version:** 1.1  
**Autor:** planetkosy  
**Beschreibung:** Ein Immobilien-Suchauftrag als Funnel mit 8 Schritten für WordPress.

---

## Beschreibung

Dieses Plugin bietet einen Klickfunnel für Immobilien-Suchaufträge mit 8 einfachen Schritten, von der Auswahl der Nutzungsart bis hin zur Angabe spezifischer Suchregionen und Kontaktdaten. Mit Versand einer Bestätigungsmail an den Auftragserfasser sowie einer Zusammenfassungsmail an den Funnelbetreiber.

---

## Features

- **Step-by-Step Funnel**: Nutzer werden in acht Schritten durch den Suchauftrag geführt.
- **Responsive Design**: Optimiert für alle Endgeräte.
- **Dynamische Eingabeformulare**: Radio-Buttons, Slider, und Freitextfelder.
- **Zusammenfassungsansicht**: Übersicht der Eingaben vor dem Absenden.
- **Datenschutzkonform**: Zustimmung zur Datenschutzerklärung erforderlich.
- **Cloudflare Turnstile CAPTCHA**: Schutz vor Bots.

---

## Installation

1. Lade das Plugin-Verzeichnis in `/wp-content/plugins/` hoch.
2. Aktiviere das Plugin in deinem WordPress-Adminbereich.
3. **Nimm die Mindestkonfiguration wie im Abschnitt Konfiguration beschrieben vor**
3. Verwende den Shortcode `[immo_funnel]`, um den Funnel einzubinden.

---

## Konfiguration

1. Die Konfiguration des Plugins kannst du auf der Einstellungsseite im `wp-admin-bereich` vornehmen.
2. **Mindestkonfiguration**:
   - Turnstile CAPTCHA `Sitekey` und `Secretkey` müssen zwingend angegeben werden, da das Plugin sonst nicht funktioniert.
   - Angabe des Seiten- oder Firmennamens.
   - Angabe des Seitennamens auf welcher der Shortcode `[immo_funnel]` eingebettet wird zwingend erforderlich, da das Plugin sonst nicht funktioniert.
   - Angabe von Sender- und Empfänger-E-Mail-Adresse für den Mailversand.
   - Verlinkung zur Datenschutzerklärung.
3. **SMTP-Mail Plugin**:  
   Ein korrekt konfiguriertes SMTP-Mail-Plugin ist erforderlich, um den Mailversand zu ermöglichen.
4. **Bestätigung-E-Mail-Vorlage**:  
   Die E-Mail-Vorlage `/templates/confirmation-email-template.php` sollte an eure Bedürfnisse angepasst werden.
5. **Zusätzliche Konfigurationsmöglichkeiten:**
   - Ratelimits, Session-Zeit, Farben, Icons und einige Styles können individuell angepasst werden.
   - Zur Anpassung der Icons an deine defienierten Funnel-Farben, bearbeite oder ersetze die entsprechenden `/assets/icons/*.png`-Dateien.
6. **Zusammenfassungs-E-Mail-Vorlage:**
   Die E-Mail-Vorlage `/templates/admin-email-template.php` kann im Bedarfsfall angepasst werden.
7. **Anpassungen des Funnel-Inhalts:**
   Anpassungen am Inhalt des Funnels können im Bedarfsfall in der Datei `/template/immo-funnel-template.php` vorgenommen werden.

---

## Schritte im Funnel

1. **Nutzungsart wählen** (Eigennutzung, Vermietung, Beides)  
2. **Immobilienart auswählen** (z. B. Einfamilienhaus, Eigentumswohnung)  
3. **Details eingeben** (z. B. Grundstücksgröße, Wohnfläche, Kaufpreis)  
4. **Ausstattungsmerkmale** (z. B. Balkon, Keller, Garage je nach Immobilienauswahl)  
5. **Suchregion festlegen** (PLZ, Ort, Radius)  
6. **Freitextfeld für Wünsche**  
7. **Kontaktdaten erfassen**  
8. **Zusammenfassung & Absenden**

---

## Support

Bei Fragen oder Problemen, bitte an martin@planetkosy.de wenden.

---

## Unterstützung

Dieses Plugin ist kostenlos und Open Source. Wenn dir meine Arbeit gefällt, kannst du mich gerne mit einer kleinen Spende unterstützen:

[![Spenden mit PayPal](https://img.shields.io/badge/Spenden-PayPal-blue?logo=paypal)](https://www.paypal.me/planetkosy)

Vielen Dank! 🙏

---

## Lizenz

Dieses Plugin ist unter der MIT-Lizenz veröffentlicht. Sie können es frei verwenden, ändern und verbreiten, solange der folgende Lizenztext in allen Kopien enthalten ist.

MIT License

Copyright (c) 2024 planetkosy

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

