 **Run stack:**
 
 `docker-compose  -f docker-compose-prod.yml up -d`
 
 **First time you must init db:**
 
 `docker-compose  -f docker-compose-prod.yml  exec backend /app/vendor/bin/phalcon-migrations migration run --directory=/app`
 
 