<?php
include "header.php";
    ?>
<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-6">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">contact</h1>
                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="contact_insert.php" method="post">
                        <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name"
                            name="contact_name">
                        <input type="contact_subject" class="w-100 form-control border-0 py-3 mb-4"
                            placeholder="Enter Your subject" name="contact_subject">

                        <input type="contact_name" class="w-100 form-control border-0 py-3 mb-4"
                            placeholder="Enter Your Email" name="contact_emali">

                        <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message"
                            name="contact_message"></textarea>
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary "
                            type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="h-100 rounded">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d60686.875338011545!2d74.75711309999998!3d18.0748085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1744001816619!5m2!1sen!2sin"
                            width="540" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Contact End -->


<?php
include "footer.php";
?>