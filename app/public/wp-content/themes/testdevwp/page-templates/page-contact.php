<?php
/*
Template Name: Contact
*/
get_header(); ?>
<div id="contact-container" class="mx-auto mb-5">
    <div class="contact-form pb-5">
        <form action="" method="post">
            <div class="mb-3 d-flex">
                <div class="w-50 me-3">
                    <p id="error-name"></p>
                    <label class="form-label" for="name">Nom</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="w-50 ms-3">
                    <p id="error-firstname"></p>
                    <label class="form-label" for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <p id="error-email"></p>
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <p id="error-subject"></p>
                <label class="form-label" for="subject">Objet</label>
                <input type="text" id="subject" name="subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <p id="error-message"></p>
                <label class="form-label" for="message">Message</label>
                <textarea id="message" name="message" class="form-control" rows="7" required></textarea>
            </div>
            <div class="text-end">
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</div>

<?php get_footer(); ?>