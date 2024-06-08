##################
#Base image
##################
FROM ubuntu as build
RUN apt-get update && apt-get install -y golang-go
ENV GO111MODULE=off
COPY . .
RUN CGO_ENABLED=0 go build -o /app .

#####################
# Here start multistage build
#####################
FROM scratch
#copy the compile binary from the build stage
COPY --from=build /app /app
#set the entry point for the container to the binary
ENTRYPOINT [ "/app" ] 