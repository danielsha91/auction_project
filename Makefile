JC = javac

all: MyParserSkeleton.class

MyParserSkeleton.class: MyParserSkeleton.java
	$(JC) MyParserSkeleton.java

clean:
	rm -rf *.class
