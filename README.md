##Install composer process

#composer install

##Install Symfony process

##TO run http rest client, cd to the cloned repo directory and run

#symfony serve

or

##TO run unit test, cd to the cloned repo directory and run

#symfony server --no-tls


#php bin/console doctrine:database:create

#php bin/console doctrine:migrations:migrate

#php bin/console doctrine:fixtures:load

#php bin/phpunit src/Tests/BookingControllerTest

#php bin/phpunit src/Tests/BookingRepoTest



##Sample json
#{
#  "hotelname" : "Free",
#  "category"  : "Hotel",
#  "price"     : 14.50,
#  "rating"    :1,
#  "availability": 56,
#  "zipcode": 50000,
#  "image" : "https://www.example.com",
#}


##API
  #GET          /api/bookingByRating/{rating}
  #GET          /api/bookingByCategory/{category}
  #GET          /api/bookingByCity/{city}
  #GET          /api/bookingByReputationBadge/{reputationbadge}
  #GET          /api/bookingByAvailabilityLess/{availability}
  #GET          /api/bookingByAvailabilityGreater/{availability}
  #POST         /api/booking
