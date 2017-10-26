ROOTFLAGS = $(shell root-config --cflags)
ROOTLIBS = $(shell root-config --libs)

all: ContourPlot

clean:
	rm -rf ContourPlot

ContourPlot: ContourPlot.cc
	c++ ContourPlot.cc -o ContourPlot $(ROOTFLAGS) $(ROOTLIBS)
