# Costs to Expect Website

The website is the public site for the Costs to Expect service.

## What does it cost to raise a child in the UK?

Costs to Expect is a long-term social experiment; my wife and I are tracking the expenses to raise our children to adulthood, 18.

## Why?

There are two core reasons. Firstly, I love data, the more then merrier. Secondly, for as long I remember, it appears to have become accepted knowledge that it costs approximately £250,000 to raise a child in the UK.
 
If you think about that number, it becomes apparent very quickly that it just can't be correct for the majority of the UK, on average, over £10k a year?

## Set up

I'm going to assume you are using Docker, if not you should be able to work out what you need to run for your development setup, go to the project root directory and run the below.

### Environment
- Run `docker-compose build`
- Run `docker-compose up`

### Configure
We now have a working environment, lets set up the app. There is only one Docker service, website, we need to 
exec into the website service to finish our set up

First, let us check we are trying to access the right place, `run docker-compose exec website ls`. You should see a 
list of the files and directories at the root of our project, if you can see artisan, you are in the right place, 
otherwise see where you are and adjust accordingly.

Now we need to set up the app by setting our .env, installing our dependencies.

Copy the .env.example file and name the copy .env, set your environment settings
Run `docker-compose exec api composer install`
Run `docker-compose exec api php artisan key:generate`

You are done, access the app at the host you defined.
