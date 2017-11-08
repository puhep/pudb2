#include <vector>
#include <fstream>
#include <string>
#include <iostream>

#include "TStyle.h"
#include "TGraph2D.h"
#include "TAxis.h"
#include "TCanvas.h"

using namespace std;

void parseLine(std::string line, std::string delimiter, std::vector<float> *v) {
  unsigned int i=0;
  int j=0;
  while (i<=line.size() && j>-1) {
    j=line.find(delimiter, i);
    v->push_back(atof(line.substr(i, j-i).c_str()));
    i=j+1;
  }
}

void ContourPlot(string id, string inFilename, string desc, string outFilename) {
  // Open CSV file to read
  std::string inFile="../../phase_2/files/sheet/" + id + "/" + inFilename;
  ifstream file(inFile.c_str());
  string line;

  // Loop over the CSV file and feed data into TGraph2D
  TGraph2D *g=new TGraph2D();
  unsigned int i=0;
  while(getline(file, line)) {
    std::vector<float> v_pos;
    parseLine(line, ",", &v_pos);
    g->SetPoint(i, v_pos[0], v_pos[1], v_pos[2]*1000.);
    ++i;
  }

  // Pretty up the TGraph2D
//  g->SetTitle((desc+"; x (mm); y (mm); #mum").c_str());
  g->SetTitle((desc+"; x (mm); y (mm); #mum").c_str());

  g->GetZaxis()->SetTitleOffset(1.5);
  TStyle *style=new TStyle();
  style->SetCanvasBorderMode(0);
  style->SetCanvasColor(0);
  style->SetPalette(1,0);
  style->SetPadRightMargin(0.17);
  style->SetPadLeftMargin(0.12);
  style->SetTitleXOffset(1.0);
  style->SetTitleYOffset(1.52);
  style->SetTitleFillColor(0);
  style->SetTitleBorderSize(0);
  style->SetTitleW(1);
  style->cd();

  // Draw and save the plot
  TCanvas *c=new TCanvas("c", "c", 700, 700);
  g->Draw("colz cont4");
  std::string outFile="../../phase_2/pics/sheet/" + id + "/" + outFilename;
  c->SaveAs(outFile.c_str());
}

int main(int argc, char *argv[]) {
  if (argc>=5) {
    string id          = argv[1]; // sheet id
    string inFilename  = argv[2];
    string desc        = argv[3]; // title of graph
    string outFilename = argv[4]; // output file name
    ContourPlot(id,inFilename, desc, outFilename);
  } else {
    std::cout<<"At least three arguments, filedir, inFilename, outFilename, expected by ContourPlot. Did not get that."<<std::endl;
  }

  return 0;
}
