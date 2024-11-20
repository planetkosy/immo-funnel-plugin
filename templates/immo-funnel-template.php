<?php
global $immo_funnel_icons;
global $immo_funnel_colors;
global $immo_funnel_styles;
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immobilien-Such-Funnel</title>
</head>

<body>
    <div class="form-container">
        <div class="progress-bar-container">
            <div class="progress-bar">
                <div class="step-progress" id="stepProgress1"></div>
                <div class="step-progress" id="stepProgress2"></div>
                <div class="step-progress" id="stepProgress3"></div>
                <div class="step-progress" id="stepProgress4"></div>
                <div class="step-progress" id="stepProgress5"></div>
                <div class="step-progress" id="stepProgress6"></div>
                <div class="step-progress" id="stepProgress7"></div>
                <div class="step-progress" id="stepProgress8"></div>
            </div>
        </div>
        <form id="immo-funnel" action="<?php echo esc_url($action_url); ?>" method="POST">
            <?php echo $csrf_token_input; ?>
            <!--[csrf_token]-->
            <div id="step1" class="step active">
                <div class="top-button-container">
                    <button type="button" class="back-button" style="visibility: hidden">zurück</button>
                    <button type="button" class="next-button" id="btnStep1" onclick="nextStep(1)" disabled
                        style="visibility: hidden">Weiter</button>
                </div>
                <h2>Wofür möchtest Du die Immobilie nutzen?</h2>
                <div id="container-auswahl-nutzung" class="radio-group">
                    <label class="custom-radio">
                        <input type="radio" name="nutzung" value="Eigennutzung" onchange="nextStep(1)">
						<img src="<?php echo esc_url($immo_funnel_icons['Eigennutzung']); ?>" alt="Eigennutzung">
                        <!--[immo_image src="eigen.png" alt="Eigennutzung"]-->
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="nutzung" value="Vermietung" onchange="nextStep(1)">
						<img src="<?php echo esc_url($immo_funnel_icons['Vermietung']); ?>" alt="Vermietung">
                        <!--[immo_image src="rent.png" alt="Vermietung"]-->
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="nutzung" value="Eigennutzung und Vermietung" onchange="nextStep(1)">
						<img src="<?php echo esc_url($immo_funnel_icons['Beides']); ?>" alt="beides">
                        <!--[immo_image src="beides.png" alt="beides"]-->
                    </label>
                </div>
            </div>
            <div id="step2" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" onclick="prevStep(2)">zurück</button>
                    <button type="button" class="next-button" id="btnStep2" style="visibility: hidden"
                        onclick="nextStep(2)" disabled>Weiter</button>
                </div>
                <h2>Welche Art von Immobilie suchst Du?</h2>
                <div id="container-auswahl-immo" class="radio-group">
                    <label class="custom-radio">
                        <input type="radio" name="immobilie" value="efh" onchange="nextStep(2)">
						<img src="<?php echo esc_url($immo_funnel_icons['EFH']); ?>" alt="Einfamilienhaus (EFH)">
                        <!--[immo_image src="efh.jpg" alt="Einfamilienhaus (EFH)"]-->
                        <span>Einfamilienhaus</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="immobilie" value="etw" onchange="nextStep(2)">
						<img src="<?php echo esc_url($immo_funnel_icons['ETW']); ?>" alt="Eigentumswohnung (ETW)">
                        <!--[immo_image src="etw.jpg" alt="Eigentumswohnung (ETW)"]-->
                        <span>Eigentumswohnung</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="immobilie" value="dhh" onchange="nextStep(2)">
						<img src="<?php echo esc_url($immo_funnel_icons['DHH']); ?>" alt="Doppelhaushälfte (DHH)">
                        <!--[immo_image src="dhh.jpg" alt="Doppelhaushälfte (DHH)"]-->
                        <span>Doppelhaushälfte</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="immobilie" value="rh" onchange="nextStep(2)">
						<img src="<?php echo esc_url($immo_funnel_icons['RH']); ?>" alt="Reihenhaus (RH)">
                        <!--[immo_image src="rh.jpg" alt="Reihenhaus (RH)"]-->
                        <span>Reihenhaus</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="immobilie" value="mfh" onchange="nextStep(2)">
						<img src="<?php echo esc_url($immo_funnel_icons['MFH']); ?>" alt="Mehrfamilienhaus (MFH)">
                        <!--[immo_image src="mfh.jpg" alt="Mehrfamilienhaus (MFH)"]-->
                        <span>Mehrfamilienhaus</span>
                    </label>
                    <label class="custom-radio">
                        <input type="radio" name="immobilie" value="grundstueck" onchange="nextStep(2)">
						<img src="<?php echo esc_url($immo_funnel_icons['GS']); ?>" alt="Grundstück (GS)">
                        <!--[immo_image src="gs.jpg" alt="Grundstück"]-->
                        <span>Grundstück</span>
                    </label>
                </div>
            </div>
            <div id="step3" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" onclick="prevStep(3)">zurück</button>
                    <button type="button" class="next-button" id="btnStep3" onclick="nextStep(3)"
                        disabled>Weiter</button>
                </div>
                <h2>Details</h2>
                <div id="efh_dhh_rh" class="immobilien-details" style="display:none;">
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Grundstücksgröße:</span>
                        </div>
                        <div id="grundstuecksgroesse_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="grundstuecksgroesse_min">0</span> m² bis <span
                                id="grundstuecksgroesse_max">5000</span>
                            m²
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Wohnfläche:</span>
                        </div>
                        <div id="wohnflaeche_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="wohnflaeche_min">0</span> m² bis <span id="wohnflaeche_max">500</span> m²
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Anzahl Zimmer:</span>
                        </div>
                        <div id="anzahlZimmer_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="anzahlZimmer_min">0</span> bis <span id="anzahlZimmer_max">10</span>
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Kaufpreis:</span>
                        </div>
                        <div id="kaufpreis_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="kaufpreis_min">0</span> € bis <span id="kaufpreis_max">1000000</span> €
                        </div>
                    </div>
                </div>
                <div id="etw" class="immobilien-details" style="display:none;">
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Wohnfläche:</span>
                        </div>
                        <div id="wohnflaeche_etw_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="wohnflaeche_etw_min">0</span> m² bis <span id="wohnflaeche_etw_max">500</span> m²
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Anzahl Zimmer:</span>
                        </div>
                        <div id="anzahlZimmer_etw_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="anzahlZimmer_etw_min">0</span> bis <span id="anzahlZimmer_etw_max">10</span>
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Kaufpreis:</span>
                        </div>
                        <div id="kaufpreis_etw_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="kaufpreis_etw_min">0</span> € bis <span id="kaufpreis_etw_max">1000000</span> €
                        </div>
                    </div>
                </div>
                <div id="mfh" class="immobilien-details" style="display:none;">
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Grundstücksgröße:</span>
                        </div>
                        <div id="grundstuecksgroesse_mfh_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="grundstuecksgroesse_mfh_min">0</span> m² bis <span
                                id="grundstuecksgroesse_mfh_max">5000</span> m²
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Wohneinheiten:</span>
                        </div>
                        <div id="wohneinheiten_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="wohneinheiten_min">0</span> bis <span id="wohneinheiten_max">50</span>
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Kaufpreis:</span>
                        </div>
                        <div id="kaufpreis_mfh_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="kaufpreis_mfh_min">0</span> € bis <span id="kaufpreis_mfh_max">2000000</span> €
                        </div>
                    </div>
                </div>
                <div id="grundstueck" class="immobilien-details" style="display:none;">
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Grundstücksgröße:</span>
                        </div>
                        <div id="grundstuecksgroesse_grundstueck_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="grundstuecksgroesse_grundstueck_min">0</span> m² bis <span
                                id="grundstuecksgroesse_grundstueck_max">5000</span> m²
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span>Kaufpreis:</span>
                        </div>
                        <div id="kaufpreis_grundstueck_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="kaufpreis_grundstueck_min">0</span> € bis <span
                                id="kaufpreis_grundstueck_max">1000000</span> €
                        </div>
                    </div>
                </div>
            </div>

            <div id="step4" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" onclick="prevStep(4)">zurück</button>
                    <button type="button" class="next-button" id="btnStep4" onclick="nextStep(4)"
                        disabled>Weiter</button>
                </div>
                <h2>Weitere Details</h2>
                <div id="efh_dhh_rh_ausstattung" class="immobilien-ausstattung" style="display:none;">
                    <h4>Wähle bitte die mindestens zu erreichende Energieeffizienzklasse aus.</h4>
                    <div class="energie-radio-group">
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="A+" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['A+']); ?>" alt="A+">
                            <!--[immo_image src="aplus.png" alt="A+"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="A" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['A']); ?>" alt="A">
                            <!--[immo_image src="a.png" alt="A"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="B" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['B']); ?>" alt="B">
                            <!--[immo_image src="b.png" alt="B"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="C" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['C']); ?>" alt="C">
                            <!--[immo_image src="c.png" alt="C"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="D" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['D']); ?>" alt="D">
                            <!--[immo_image src="d.png" alt="D"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="E" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['E']); ?>" alt="E">
                            <!--[immo_image src="e.png" alt="E"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="F" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['F']); ?>" alt="F">
                            <!--[immo_image src="f.png" alt="F"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="G" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['G']); ?>" alt="G">
                            <!--[immo_image src="g.png" alt="G"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="H" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['H']); ?>" alt="H">
                            <!--[immo_image src="h.png" alt="H"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_efh_dhh_rh" value="egal" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['EGAL']); ?>" alt="egal">
                            <!--[immo_image src="egal.png" alt="egal"]-->
                        </label>
                    </div>
                    <h4>Wähle bitte die gewünschten Ausstattungsmerkmale aus.</h4>
                    <div class="checkbox-container">
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_bungalow">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_bungalow">Bungalowstil</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_keller">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_keller">Keller</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_garage">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_garage">Garage</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_carport">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_carport">Carpot</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_kamin">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_kamin">Kamin</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_fussheizung">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_fussheizung">Fußbodenheizung</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_gaestewc">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_gaestewc">Gäste-WC</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_badfenster">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_badfenster">Bad mit Fenster</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="efh_dhh_rh_pool">
                            <span class="custom-checkbox"></span>
                            <label for="efh_dhh_rh_pool">Pool</label>
                        </div>
                    </div>
                </div>
                <div id="etw_ausstattung" class="immobilien-ausstattung" style="display:none;">
                    <h4>Wähle bitte die mindestens zu erreichende Energieeffizienzklasse aus.</h4>
                    <div class="energie-radio-group">
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="A+" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['A+']); ?>" alt="A+">
                            <!--[immo_image src="aplus.png" alt="A+"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="A" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['A']); ?>" alt="A">
                            <!--[immo_image src="a.png" alt="A"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="B" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['B']); ?>" alt="B">
                            <!--[immo_image src="b.png" alt="B"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="C" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['C']); ?>" alt="C">
                            <!--[immo_image src="c.png" alt="C"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="D" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['D']); ?>" alt="D">
                            <!--[immo_image src="d.png" alt="D"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="E" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['E']); ?>" alt="E">
                            <!--[immo_image src="e.png" alt="E"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="F" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['F']); ?>" alt="F">
                            <!--[immo_image src="f.png" alt="F"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="G" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['G']); ?>" alt="G">
                            <!--[immo_image src="g.png" alt="G"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="H" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['H']); ?>" alt="H">
                            <!--[immo_image src="h.png" alt="H"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_etw" value="egal" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['EGAL']); ?>" alt="egal">
                            <!--[immo_image src="egal.png" alt="egal"]-->
                        </label>
                    </div>
                    <h4>Wähle bitte die gewünschten Ausstattungsmerkmale aus.</h4>
                    <div class="checkbox-container">
                        <div class="custom-check">
                            <input type="checkbox" id="etw_balkon">
                            <span class="custom-checkbox"></span>
                            <label for="etw_balkon">Balkon</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_terrasse">
                            <span class="custom-checkbox"></span>
                            <label for="etw_terrasse">Terrasse</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_gartenanteil">
                            <span class="custom-checkbox"></span>
                            <label for="etw_gartenanteil">Gartenanteil</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_stellplatz">
                            <span class="custom-checkbox"></span>
                            <label for="etw_stellplatz">Stellplatz</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_tgstellplatz">
                            <span class="custom-checkbox"></span>
                            <label for="etw_tgstellplatz">TG-Stellplatz</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_badfenster">
                            <span class="custom-checkbox"></span>
                            <label for="etw_badfenster">Bad mit Fenster</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_gaestewc">
                            <span class="custom-checkbox"></span>
                            <label for="etw_gaestewc">Gäste-WC</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_fussheizung">
                            <span class="custom-checkbox"></span>
                            <label for="etw_fussheizung">Fußbodenheizung</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="etw_abstellraum">
                            <span class="custom-checkbox"></span>
                            <label for="etw_abstellraum">Abstellraum</label>
                        </div>
                    </div>
                </div>
                <div id="mfh_ausstattung" class="immobilien-ausstattung" style="display:none;">
                    <h4>Wähle bitte die mindestens zu erreichende Energieeffizienzklasse aus.</h4>
                    <div class="energie-radio-group">
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="A+" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['A+']); ?>" alt="A+">
                            <!--[immo_image src="aplus.png" alt="A+"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="A" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['A']); ?>" alt="A">
                            <!--[immo_image src="a.png" alt="A"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="B" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['B']); ?>" alt="B">
                            <!--[immo_image src="b.png" alt="B"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="C" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['C']); ?>" alt="C">
                            <!--[immo_image src="c.png" alt="C"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="D" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['D']); ?>" alt="D">
                            <!--[immo_image src="d.png" alt="D"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="E" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['E']); ?>" alt="E">
                            <!--[immo_image src="e.png" alt="E"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="F" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['F']); ?>" alt="F">
                            <!--[immo_image src="f.png" alt="F"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="G" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['G']); ?>" alt="G">
                            <!--[immo_image src="g.png" alt="G"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="H" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['H']); ?>" alt="H">
                            <!--[immo_image src="h.png" alt="H"]-->
                        </label>
                        <label class="energie-radio">
                            <input type="radio" name="energie_mfh" value="egal" onchange="validateStep4()">
							<img src="<?php echo esc_url($immo_funnel_icons['EGAL']); ?>" alt="egal">
                            <!--[immo_image src="egal.png" alt="egal"]-->
                        </label>
                    </div>
                    <h4>Wähle bitte die gewünschten Ausstattungsmerkmale aus.</h4>
                    <div class="checkbox-container">
                        <div class="custom-check">
                            <input type="checkbox" id="mfh_tg">
                            <span class="custom-checkbox"></span>
                            <label for="mfh_tg">Tiefgarage</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="mfh_garage">
                            <span class="custom-checkbox"></span>
                            <label for="mfh_garage">Garagen</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="mfh_stellplatz">
                            <span class="custom-checkbox"></span>
                            <label for="mfh_stellplatz">Stellplätze</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="mfh_voll">
                            <span class="custom-checkbox"></span>
                            <label for="mfh_voll">voll vermietet</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="mfh_leer">
                            <span class="custom-checkbox"></span>
                            <label for="mfh_leer">leerstehend</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="mfh_sanierung">
                            <span class="custom-checkbox"></span>
                            <label for="mfh_sanierung">sanierungsbedürftig</label>
                        </div>
                    </div>
                </div>
                <div id="grundstueck_ausstattung" class="immobilien-ausstattung" style="display:none;">
                    <h4>Wähle bitte die gewünschten Ausstattungsmerkmale aus.</h4>
                    <div class="checkbox-container">
                        <div class="custom-check">
                            <input type="checkbox" id="gs_baugrundstueck">
                            <span class="custom-checkbox"></span>
                            <label for="gs_baugrundstueck">Baugrundstück</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="gs_bauerwartungsland">
                            <span class="custom-checkbox"></span>
                            <label for="gs_bauerwartungsland">Bauerwartungsland</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="gs_neubausiedlung">
                            <span class="custom-checkbox"></span>
                            <label for="gs_neubausiedlung">Neubau-Siedlung</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="gs_bautraeger">
                            <span class="custom-checkbox"></span>
                            <label for="gs_bautraeger">Bauträgerfrei</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="gs_erschlossen">
                            <span class="custom-checkbox"></span>
                            <label for="gs_erschlossen">Grundstück erschlossen</label>
                        </div>
                        <div class="custom-check">
                            <input type="checkbox" id="gs_sonstiges">
                            <span class="custom-checkbox"></span>
                            <label for="gs_sonstiges">sonstiges Grundstück</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step5" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" onclick="prevStep(5)">zurück</button>
                    <button type="button" class="next-button" id="btnStep5" onclick="nextStep(5)"
                        disabled>Weiter</button>
                </div>
                <h2>Ihre Suchregion</h2>
                <div id="suchregion">
                    <h4>Bitte trage eine Postleitzahl und einen Ort / Ortsteil ein.</h4>
                    <div class="text-group">
                        <label class="custom-text">
                            <input type="text" id="plz" name="plz" maxlength="5" placeholder="Postleitzahl"
                                onchange="validateStep5()">
                        </label>
                        <label class="custom-text">
                            <input type="text" id="ort" name="ort" placeholder="Ort / Ortsteil"
                                onchange="validateStep5()">
                        </label>
                    </div>
                    <h4>Bei Bedarf bitte einen Suchradius festlegen.</h4>
                    <div class="slider-container">
                        <div class="slider-description">
                            <span></span>
                        </div>
                        <div id="radius_slider" class="slider"></div>
                        <div class="slider-values">
                            <span id="radius_value">0 km</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step6" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" onclick="prevStep(6)">zurück</button>
                    <button type="button" class="next-button" id="btnStep6" onclick="nextStep(6)">Weiter</button>
                </div>
                <h2>Weitere Informationen</h2>
                <div class="custom-textarea">
                    <textarea id="weitere_info" name="weitere_info" rows="11" maxlength="1200"
                        placeholder="Gib hier weitere wichtige Informationen zu der gesuchten Immobilie ein..."
                        oninput="updateCharCount()"></textarea>
                    <div id="char-count" class="char-count">Verbleibende Zeichen: 1200</div>
                </div>
            </div>
            <div id="step7" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" onclick="prevStep(7)">zurück</button>
                    <button type="button" class="next-button" id="btnStep7" onclick="nextStep(7)"
                        disabled>Weiter</button>
                </div>
                <h2>Deine Kontaktdaten</h2>
                <h4>Eine Bearbeitung Deines Suchauftrages ist nur mit vollständigen und korrekten Angaben möglich.</h4>
                <div class="text-group">
                    <label class="custom-text">
                        <input type="text" id="vorname" name="vorname" maxlength="50" placeholder="Vorname"
                            onchange="validateStep7()">
                    </label>
                    <label class="custom-text">
                        <input type="text" id="name" name="name" maxlength="50" placeholder="Nachname"
                            onchange="validateStep7()">
                    </label>
                    <label class="custom-text">
                        <input type="email" id="email" name="email" maxlength="100" placeholder="E-Mail"
                            onchange="validateStep7()">
                    </label>
                    <label class="custom-text">
                        <input type="tel" id="telefonnummer" name="telefonnummer" maxlength="20"
                            placeholder="Telefonnummer" onchange="validateStep7()">
                    </label>
                </div>

            </div>
            <div id="step8" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" onclick="prevStep(8)">zurück</button>
                </div>
                <h2>Zusammenfassung</h2>
                <div id="summary">
                </div>
                <div class="datenschutz-container">
                    <p>Deine Daten sind uns sehr wichtig und werden daher ausschließlich zur Bearbeitung Deiner Anfrage
                        verwendet. Einer Verwendung Deiner Daten kannst Du jederzeit widersprechen. Eine Weitergabe
                        Deiner Daten an Dritte findet nicht statt.</p>
                </div>
                <div class="datenschutz-check">
                    <input type="checkbox" id="datenschutz" name="datenschutz">
                    <span class="custom-checkbox"></span>
                    <label for="datenschutz">Ich habe die <a href="<?php echo esc_url(PRIVACY_POLICY); ?>"
                            target="_blank" rel="noopener">Datenschutzerklärung</a> gelesen und akzeptiert.</label>
                </div>
                <div class="bottom-button-container">
                    <button type="submit" class="submit-button" id="btnSubmit" disabled>Absenden</button>
                </div>
                <div class="captcha-description" id="captcha-hint" style="display: none;">
                    <p>Wir prüfen nur kurz, ob du ein Mensch bist.</p>
                </div>
                <div class="captcha-container" id="turnstile-container"></div>
            </div>
            <div id="thankyou" class="step">
                <div class="top-button-container">
                    <button class="back-button" style="visibility: hidden;">zurück</button>
                </div>
                <h2>Vielen Dank für Deinen Suchauftrag!</h2>
                <p>Bei relevanten Treffern werden wir uns umgehend telefonisch oder per Mail mit dir in Verbindung
                    setzen.</p>
                <p>Suchst Du weitere Immobilien, erstelle gern einen weiteren Suchauftrag.</p>
                <div class="bottom-button-container">
                    <button type="button" class="new-button" id="btnStepThankYou" onclick="location.reload()">Neuer
                        Auftrag</button>
                </div>
            </div>
            <div id="error-send-mail" class="step">
                <div class="top-button-container">
                    <button type="button" class="back-button" style="visibility: hidden;">zurück</button>
                </div>
                <h2>Upss.. Da ist etwas schief gelaufen.</h2>
                <p>Dein Suchauftrag konnte leider nicht an uns übermittelt werden.</p>
                <p>Versuche die Seite neu zu laden oder probiere es bitte zu einem späterem Zeitpunkt noch einmal.</p>
                <div class="bottom-button-container">
                    <button type="button" class="new-button" id="btnStepErrorSendMail" onclick="location.reload()">Neuer
                        Auftrag</button>
                </div>
            </div>
        </form>
        <div class="copyright">
            created by planetkosy
        </div>
    </div>
</body>

</html>