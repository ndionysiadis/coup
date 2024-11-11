<script setup lang="ts">
import Copyrights from "@/Components/Copyrights.vue";
import {
    PhAt,
    PhCookie,
    PhDetective,
    PhFacebookLogo,
    PhFileText,
    PhInstagramLogo,
    PhMapPin,
    PhPhone,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import TextLink from "@/Components/Links/TextLink.vue";
import PrimaryModal from "@/Components/Modals/PrimaryModal.vue";
import { ref } from "vue";

const privacyModalOpen = ref<boolean>(false);
const cookieModalOpen = ref<boolean>(false);
const termsModalOpen = ref<boolean>(false);
</script>

<template>
    <footer
        class="flex flex-col items-center justify-center gap-2 bg-gray-800/70 p-2"
    >
        <div class="flex items-center gap-4">
            <AppLink href="https://www.facebook.com/CoupEspressoWine" blank>
                <PhFacebookLogo
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="https://www.instagram.com/coupespressowinebar" blank>
                <PhInstagramLogo
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="https://maps.app.goo.gl/zjSKnrGaE43eZSJb9" blank>
                <PhMapPin
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="callto:2384501161" blank>
                <PhPhone
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>

            <AppLink href="mailto:coup.ewb@gmail.com" blank>
                <PhAt
                    :size="32"
                    weight="fill"
                    class="mt-0.5 text-gray-600 hover:text-gray-400"
                />
            </AppLink>
        </div>

        <div
            class="flex flex-col items-center gap-2 text-sm text-gray-300 underline underline-offset-4 md:flex-row"
        >
            <div
                class="cursor-pointer hover:text-gray-100"
                @click="privacyModalOpen = !privacyModalOpen"
            >
                Πολιτική Απορρήτου
            </div>

            <div
                @click="cookieModalOpen = !cookieModalOpen"
                class="cursor-pointer hover:text-gray-100"
            >
                Πολιτική Cookie
            </div>

            <div
                @click="termsModalOpen = !termsModalOpen"
                class="cursor-pointer hover:text-gray-100"
            >
                Όροι Χρήσης
            </div>
        </div>

        <PrimaryModal
            :open="privacyModalOpen"
            @closeModal="privacyModalOpen = false"
        >
            <template #icon>
                <PhDetective weight="bold" size="24" />
            </template>

            <template #title> Πολιτική Απορρήτου</template>

            <template #body>
                <div class="flex flex-col gap-2">
                    <p>
                        Στην ιστοσελίδα COUP, σεβόμαστε τα προσωπικά σας
                        δεδομένα. Χρησιμοποιούμε μόνο την υπηρεσία Google
                        Analytics για τη συλλογή στατιστικών στοιχείων. Παρακάτω
                        περιγράφονται οι όροι αυτής της συλλογής:
                    </p>

                    <p>
                        <span class="font-bold">Συλλογή Δεδομένων:</span> Η
                        Google Analytics συλλέγει ανώνυμα δεδομένα, όπως
                        πληροφορίες συσκευής, διεύθυνση IP, στατιστικά χρήσης
                        και αλληλεπιδράσεις στην εφαρμογή. Τα δεδομένα αυτά δεν
                        αναγνωρίζουν άμεσα τον χρήστη.
                    </p>
                    <p>
                        <span class="font-bold">Σκοπός Χρήσης Δεδομένων:</span>
                        Τα στοιχεία αυτά μας βοηθούν να αναλύσουμε και να
                        βελτιώσουμε την απόδοση της εφαρμογής, να κατανοήσουμε
                        την αλληλεπίδραση των χρηστών και να βελτιώσουμε την
                        εμπειρία τους.
                    </p>
                    <p>
                        <span class="font-bold">Υπηρεσίες Τρίτων:</span>
                        Χρησιμοποιούμε την υπηρεσία Google Analytics για την
                        επεξεργασία των δεδομένων. Δείτε την
                        <TextLink
                            href="https://policies.google.com/privacy?hl=el"
                            blank
                        >
                            Πολιτική Απορρήτου της Google
                        </TextLink>
                        και τους
                        <TextLink
                            href="https://support.google.com/analytics/answer/3379636?hl=el"
                            blank
                        >
                            Όρους Επεξεργασίας Δεδομένων του Google
                        </TextLink>
                        Analytics.
                    </p>
                    <p>
                        <span class="font-bold">Διατήρηση Δεδομένων:</span> Τα
                        δεδομένα διατηρούνται για 14 μήνες ή όσο απαιτείται για
                        την ανάλυση. Επιλογή Εξαίρεσης: Οι χρήστες μπορούν να
                        απενεργοποιήσουν το Google Analytics, π.χ.,
                        ενεργοποιώντας την επιλογή "Do Not Track" στον browser ή
                        χρησιμοποιώντας το
                        <TextLink
                            href="https://tools.google.com/dlpage/gaoptout"
                            blank
                            >Google Analytics Opt-Out Browser
                        </TextLink>
                        Add-on.
                    </p>

                    <p>
                        <span class="font-bold">Δικαιώματα Χρηστών:</span>
                        Ανάλογα με τους νόμους που ισχύουν, οι χρήστες έχουν
                        δικαίωμα διαγραφής, πρόσβασης ή διόρθωσης των δεδομένων
                        τους.
                    </p>
                </div>
            </template>
        </PrimaryModal>

        <PrimaryModal
            :open="cookieModalOpen"
            @closeModal="cookieModalOpen = false"
        >
            <template #icon>
                <PhCookie weight="bold" size="24" />
            </template>

            <template #title> Πολιτική Cookie</template>

            <template #body>
                <div class="flex flex-col gap-2">
                    <p>
                        Καθώς το COUP χρησιμοποιεί cookies μέσω της υπηρεσίας
                        Google Analytics, σας ενημερώνουμε για τα εξής:
                    </p>
                    <p>
                        <span class="font-bold">
                            Τύποι Cookies που Χρησιμοποιούνται:
                        </span>
                        Τα cookies χρησιμοποιούνται αποκλειστικά για αναλυτικούς
                        σκοπούς, παρακολουθώντας τη χρήση και τη συμπεριφορά
                        στην εφαρμογή, χωρίς στόχο διαφήμισης.
                    </p>
                    <p>
                        <span class="font-bold">
                            Διαχείριση και Έλεγχος Cookies:
                        </span>
                        Οι χρήστες μπορούν να διαχειριστούν ή να αποκλείσουν τα
                        cookies μέσω των ρυθμίσεων του προγράμματος περιήγησης.
                    </p>
                </div>
            </template>
        </PrimaryModal>

        <PrimaryModal
            :open="termsModalOpen"
            @closeModal="termsModalOpen = false"
        >
            <template #icon>
                <PhFileText weight="bold" size="24" />
            </template>

            <template #title>Όροι Χρήσης</template>

            <template #body>
                <div class="flex flex-col gap-2">
                    <p>
                        Για τη χρήση της εφαρμογής COUP, ισχύουν οι εξής όροι:
                    </p>

                    <p>
                        <span class="font-bold">Αποδοχή Όρων:</span>
                        Με τη χρήση της εφαρμογής αποδέχεστε τους όρους χρήσης
                        και τις πολιτικές συλλογής δεδομένων.
                    </p>
                    <p>
                        <span class="font-bold">Περιορισμένη Ευθύνη:</span>
                        Δεν φέρουμε ευθύνη για οποιαδήποτε απώλεια ή ζημιά από
                        τη χρήση της εφαρμογής.
                    </p>

                    <p>
                        <span class="font-bold">Πνευματικά Δικαιώματα:</span>
                        Όλο το περιεχόμενο της εφαρμογής προστατεύεται από
                        πνευματικά δικαιώματα. Απαγορεύεται η μη εξουσιοδοτημένη
                        χρήση.
                    </p>

                    <p>
                        <span class="font-bold">Δικαίωμα Τροποποίησης:</span>
                        Διατηρούμε το δικαίωμα να τροποποιήσουμε τους όρους
                        χρήσης και την πολιτική απορρήτου. Σας συνιστούμε να
                        τους ελέγχετε περιοδικά.
                    </p>
                </div>
            </template>
        </PrimaryModal>

        <Copyrights />
    </footer>
</template>
